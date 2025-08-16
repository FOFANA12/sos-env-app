<?php

namespace App\Repositories;

use RuntimeException;
use App\Models\Report;
use App\Models\ReportPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportPhotoRequest;
use App\Http\Resources\ReportPhotoResource;

class ReportPhotoRepository
{
    /**
     * List report_photos with pagination, filters, and sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['report_photos.caption', 'report'];
        $sortable = ['caption', 'report'];


        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $query = ReportPhoto::select(
            'report_photos.id',
            'report_photos.uuid',
            'report_photos.caption',
            'reports.title as report',
        )
            ->join('reports', 'report_photos.report_uuid', '=', 'reports.uuid');

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {
                    if ($column === 'report') {
                        $q->orWhere('reports.title', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else {
                        $q->orWhere($column, 'LIKE', '%' . strtolower($searchTerm) . '%');
                    }
                }
            });
        }

        if ($sortBy === 'report') {
            $query->orderBy('reports.title', $sortOrder);
        } else {
            $query->orderBy("report_photos.$sortBy", $sortOrder);
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
        $reports = Report::where('status', !'completed')
            ->orderBy('id', 'desc')
            ->select('uuid', 'title')
            ->get();

        return [
            'reports' => $reports,
        ];
    }

    /**
     * Store a new report photo.
     */
    public function store(ReportPhotoRequest $request)
    {

        $request->merge([
            "mode" => $request->input('mode', 'view'),
            "report_uuid" => $request->input('report'),
            "created_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
        ]);

        $reportPhoto = ReportPhoto::create($request->only([
            "caption",
            "report_uuid",
            "created_by",
            "updated_by",
        ]));

        return new ReportPhotoResource($reportPhoto);
    }

    /**
     * Show a specific report photo.
     */
    public function show(ReportPhoto $report_photo)
    {
        return ['report_photo' => new ReportPhotoResource($report_photo)];
    }

    /**
     * Update an report photo.
     */
    public function update(ReportPhotoRequest $request, ReportPhoto $report_photo)
    {
        $request->merge([
            "mode" => $request->input('mode', 'edit'),
            "report_uuid" => $request->input('report'),
            "updated_by" => Auth::user()?->uuid,
        ]);

        $report_photo->fill($request->only([
            'caption',
            'report_uuid',
            'updated_by',
        ]))->save();

        return new ReportPhotoResource($report_photo);
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
                $deleted = ReportPhoto::whereIn('id', $ids)->delete();
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
