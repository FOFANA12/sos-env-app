<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use RuntimeException;
use App\Models\Region;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReportResource;
use App\Models\Department;
use App\Models\Neighborhood;
use App\Support\ReportStatus;
use App\Support\ReportViewMode;

class ReportRepository
{
    protected string $basePath = 'uploads/reports';

    /**
     * List reports with pagination, filters, and sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['title', 'region', 'department', 'neighborhood', 'author'];
        $sortable = ['title', 'status', 'region', 'department', 'neighborhood', 'author'];

        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $regionUuid = $request->input('region');
        $departmentUuid = $request->input('department');
        $neighborhoodUuid = $request->input('neighborhood');
        $status = $request->input('status');
        $viewMode = $request->input('view_mode', 'all'); // "all" | "mine"

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $user = $request->user();
        $isAdmin = $user && strcasecmp($user->role, 'admin') === 0;

        $query = Report::query()
            ->leftJoin('users', 'reports.created_by', '=', 'users.uuid')
            ->join('regions', 'reports.region_uuid', '=', 'regions.uuid')
            ->join('departments', 'reports.department_uuid', '=', 'departments.uuid')
            ->join('neighborhoods', 'reports.neighborhood_uuid', '=', 'neighborhoods.uuid')
            ->select(
                'reports.id',
                'reports.uuid',
                'reports.title',
                'reports.description',
                'reports.created_at',
                'reports.status',
                'reports.image',
                'regions.name as region',
                'departments.name as department',
                'neighborhoods.name as neighborhood',
                'users.name as user'
            );

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {
                    if ($column === 'region') {
                        $q->orWhere('regions.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'department') {
                        $q->orWhere('departments.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'author') {
                        $q->orWhere('users.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'neighborhood') {
                        $q->orWhere('neighborhoods.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else {
                        $q->orWhere("reports.$column", 'LIKE', '%' . strtolower($searchTerm) . '%');
                    }
                }
            });
        }

        if ($regionUuid) {
            $query->where('reports.region_uuid', $regionUuid);
        }
        if ($departmentUuid) {
            $query->where('reports.department_uuid', $departmentUuid);
        }
        if ($neighborhoodUuid) {
            $query->where('reports.neighborhood_uuid', $neighborhoodUuid);
        }
        if ($status) {
            $query->where('reports.status', $status);
        }

        if ($viewMode === 'mine' && $user) {
            $query->where('reports.created_by', $user->uuid);
        } else {
            if (!$isAdmin) {
                $query->where(function ($q) use ($user) {
                    $q->where('reports.status', '!=', 'rejected');

                    if ($user) {
                        $q->orWhere(function ($qq) use ($user) {
                            $qq->where('reports.status', 'rejected')
                                ->where('reports.created_by', $user->uuid);
                        });
                    }
                });
            }
        }

        if ($sortBy === 'region') {
            $query->orderBy('regions.name', $sortOrder);
        } else if ($sortBy === 'department') {
            $query->orderBy('departments.name', $sortOrder);
        } else if ($sortBy === 'neighborhood') {
            $query->orderBy('neighborhoods.name', $sortOrder);
        } else if ($sortBy === 'author') {
            $query->orderBy('users.name', $sortOrder);
        } else {
            $query->orderBy("reports.$sortBy", $sortOrder);
        }

        return $perPage && (int) $perPage > 0
            ? $query->paginate((int) $perPage)
            : $query->get();
    }


    /**
     * Load requirements data
     */
    public function requirements()
    {
        $user = Auth::user();
        $locale = app()->getLocale();

        $regions = Region::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();

        $departments = Department::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name', 'region_uuid')
            ->get();

        $neighborhoods = Neighborhood::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name', 'region_uuid', 'department_uuid')
            ->get();

        $statuses = collect(ReportStatus::all())
            ->filter(function ($status) use ($user) {
                if (!$user) {
                    return $status['code'] !== 'rejected';
                }
                return true;
            })
            ->map(function ($status) use ($locale) {
                return [
                    'code' => $status['code'],
                    'name' => $status['name'][$locale] ?? $status['name']['fr'],
                ];
            })
            ->values();

        $data = [
            'regions' => $regions,
            'departments' => $departments,
            'neighborhoods' => $neighborhoods,
            'statuses' => $statuses,
        ];

        if ($user) {
            if ($user) {
                $data['view_modes'] = collect(ReportViewMode::all())
                    ->map(function ($item) use ($locale) {
                        return [
                            'code' => $item['code'],
                            'name' => $item['name'][$locale] ?? $item['name']['fr'],
                        ];
                    })
                    ->values();
            }
        }

        return $data;
    }

    /**
     * Store a new reports.
     */
    public function store(ReportRequest $request)
    {
        $user = Auth::user();
        DB::beginTransaction();

        try {
            $data = [
                "region_uuid" => $request->input('region'),
                "department_uuid" => $request->input('department'),
                "neighborhood_uuid" => $request->input('neighborhood'),
                "title" => $request->input('title'),
                "description" => $request->input('description'),
                "created_by" => $user?->uuid,
                "updated_by" => $user?->uuid,
            ];

            $location = $this->extractLocationData($request);
            $data = array_merge($data, $location);

            $uploadedPhotoIds = [];
            $uploadedImageId = null;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadedImageId = FileHelper::upload($file, $this->basePath);
                $data['image'] = $uploadedImageId;
            }

            $report = Report::create($data);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $photoId = FileHelper::upload($photo, "{$this->basePath}/{$report->uuid}/photos");
                    $uploadedPhotoIds[] = $photoId;

                    $report->photos()->create([
                        'identifier' => $photoId,
                        'created_by' => $user?->uuid,
                        'updated_by' => $user?->uuid,
                    ]);
                }
            }

            DB::commit();

            $report->refresh();
            $report->load(['region', 'department', 'neighborhood', 'photos']);
            
            return new ReportResource($report);
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedImageId) {
                FileHelper::delete("{$this->basePath}/{$uploadedImageId}");
            }

            if (!empty($uploadedPhotoIds)) {
                foreach ($uploadedPhotoIds as $photoId) {
                    FileHelper::delete("{$this->basePath}/{$report->uuid}/photos/{$photoId}");
                }
            }

            throw $e;
        }
    }

    /**
     * Show a specific report.
     */
    public function show(Report $report)
    {
        return ['report' => new ReportResource($report)];
    }

    /**
     * Update an report.
     */
    public function update(ReportRequest $request, Report $report)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {
            $data = [
                "region_uuid" => $request->input('region'),
                "department_uuid" => $request->input('department'),
                "neighborhood_uuid" => $request->input('neighborhood'),
                "title" => $request->input('title'),
                "description" => $request->input('description'),
                "updated_by" => $user?->uuid,
            ];

            $location = $this->extractLocationData($request);
            $data = array_merge($data, $location);

            if ($request->boolean('delete_image') && $report->image) {
                FileHelper::delete("{$this->basePath}/{$report->image}");
                $data['image'] = null;
            }

            if ($request->hasFile('image')) {
                if ($report->image) {
                    FileHelper::delete("{$this->basePath}/{$report->image}");
                }
                $file = $request->file('image');
                $data['image'] = FileHelper::upload($file, $this->basePath);
            }

            $report->fill($data)->save();

            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                foreach ($photos as $photo) {
                    FileHelper::upload($photo, "{$this->basePath}/{$report->uuid}/photos");
                }
            }

            DB::commit();

            $report->load(['region', 'department', 'neighborhood']);
            return new ReportResource($report);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete multiple funding sources.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids) || !is_array($ids)) {
            throw new \InvalidArgumentException(__('app/common.destroy.invalid_ids'));
        }

        $filesToDelete = [];

        DB::beginTransaction();

        try {
            $reports = Report::whereIn('id', $ids)->with('photos')->get();

            if ($reports->isEmpty()) {
                throw new \RuntimeException(__('app/common.destroy.no_items_deleted'));
            }

            foreach ($reports as $report) {
                if ($report->image) {
                    $filesToDelete[] = "{$this->basePath}/{$report->image}";
                }

                if ($report->photos && $report->photos->count() > 0) {
                    foreach ($report->photos as $photo) {
                        if ($photo->photo_identifier) {
                            $filesToDelete[] = "{$this->basePath}/{$report->uuid}/photos/{$photo->identifier}";
                        }
                    }
                }
                $report->delete();
            }

            DB::commit();

            foreach ($filesToDelete as $file) {
                FileHelper::delete($file);
            }

        } catch (RuntimeException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() === "23000") {
                throw new \Exception(__('app/common.repository.foreignKey'));
            }
            throw new \Exception(__('app/common.repository.error'));
        }
    }

    /**
     * Extract location data from request.
     */
    protected function extractLocationData($request): array
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $isLatValid = is_numeric($latitude) && $latitude >= -90 && $latitude <= 90;
        $isLngValid = is_numeric($longitude) && $longitude >= -180 && $longitude <= 180;

        if (!$isLatValid || !$isLngValid) {
            return [
                'latitude' => null,
                'longitude' => null,
            ];
        }

        return [
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude,
        ];
    }
}
