<?php

namespace App\Repositories;

use RuntimeException;
use App\Models\Region;
use App\Models\Report;
use App\Models\Department;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReportResource;

class ReportRepository
{
    /**
     * List reports with pagination, filters, and sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['reports.title', 'reports.description', 'reports.address', 'region', 'report_category', 'department', 'neighborhood'];
        $sortable = ['title', 'description', 'status', 'region', 'report_category', 'department', 'neighborhood'];

        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $query = Report::select(
            'reports.id',
            'reports.uuid',
            'reports.title',
            'reports.address',
            'reports.latitude',
            'reports.longitude',
            'reports.description',
            'reports.status as status_code',
            'regions.name as region',
            'report_categories.name as category',
            'departments.name as department',
            'neighborhoods.name as neighborhood',
        )
            ->join('regions', 'reports.region_uuid', '=', 'regions.uuid')
            ->join('report_categories', 'reports.category_uuid', '=', 'report_categories.uuid')
            ->join('departments', 'reports.department_uuid', '=', 'departments.uuid')
            ->join('neighborhoods', 'reports.neighborhood_uuid', '=', 'neighborhoods.uuid');

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {
                    if ($column === 'region') {
                        $q->orWhere('regions.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'category') {
                        $q->orWhere('report_categories.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'department') {
                        $q->orWhere('departments.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'neighborhood') {
                        $q->orWhere('neighborhoods.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else {
                        $q->orWhere($column, 'LIKE', '%' . strtolower($searchTerm) . '%');
                    }
                }
            });
        }

        if ($sortBy === 'region') {
            $query->orderBy('regions.name', $sortOrder);
        }
        if ($sortBy === 'category') {
            $query->orderBy('report_categories.name', $sortOrder);
        }
        if ($sortBy === 'department') {
            $query->orderBy('departments.name', $sortOrder);
        }
        if ($sortBy === 'neighborhood') {
            $query->orderBy('neighborhoods.name', $sortOrder);
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
        $regions = Region::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();

        $departments = Department::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();
        $reportCategories = ReportCategory::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();
        $neighborhoods = Neighborhood::where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();

        return [
            'regions' => $regions,
            'departments' => $departments,
            'report_categories' => $reportCategories,
            'neighborhoods' => $neighborhoods,
        ];
    }

    /**
     * Store a new reports.
     */
    public function store(ReportRequest $request)
    {

        $request->merge([
            "is_public" => filter_var($request->input('is_public'), FILTER_VALIDATE_BOOLEAN),
            "mode" => $request->input('mode', 'view'),
            "region_uuid" => $request->input('region'),
            "category_uuid" => $request->input('category'),
            "department_uuid" => $request->input('department'),
            "neighborhood_uuid" => $request->input('neighborhood'),
            "created_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
            "published_at" => now(),
            "status_changed_at" => now(),
            "status_changed_by" => Auth::user()?->uuid,
        ]);

        $report = Report::create($request->only([
            "title",
            "region_uuid",
            "category_uuid",
            "department_uuid",
            "neighborhood_uuid",
            "description",
            "latitude",
            "longitude",
            "address",
            "status",
            "is_public",
            "published_at",
            "status_changed_at",
            "status_changed_by",
            "created_by",
            "updated_by",
        ]));
        $report->load(['region', 'category', 'department', 'neighborhood']);

        return new ReportResource($report);
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
        $request->merge([
            "is_public" => filter_var($request->input('is_public'), FILTER_VALIDATE_BOOLEAN),
            "mode" => $request->input('mode', 'edit'),
            "region_uuid" => $request->input('region'),
            "category_uuid" => $request->input('category'),
            "department_uuid" => $request->input('department'),
            "neighborhood_uuid" => $request->input('neighborhood'),
            "status_changed_at" => now(),
            "status_changed_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
        ]);

        $report->fill($request->only([
            "title",
            "region_uuid",
            "category_uuid",
            "department_uuid",
            "neighborhood_uuid",
            "description",
            "latitude",
            "longitude",
            "address",
            "status",
            "is_public",
            "status_changed_at",
            "status_changed_by",
            "updated_by",
        ]))->save();

        return new ReportResource($report);
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
        DB::transaction(function () use ($ids) {
            try {
                $deleted = Report::whereIn('id', $ids)->delete();
                if ($deleted === 0) {
                    throw new \RuntimeException(__('app/common.destroy.no_items_deleted'));
                }
            } catch (RuntimeException $e) {
                throw $e;
            } catch (\Exception $e) {
                if ($e->getCode() === "23000") {
                    throw new \Exception(__('app/common.repository.foreignKey'));
                }

                throw new \Exception(__('app/common.repository.error'));
            }
        });
    }
}
