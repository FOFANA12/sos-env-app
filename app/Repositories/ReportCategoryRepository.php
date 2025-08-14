<?php

namespace App\Repositories;

use RuntimeException;
use Illuminate\Http\Request;
use App\Models\ReportCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportCategoryRequest;
use App\Http\Resources\ReportCategoryResource;

class ReportCategoryRepository
{
    /**
     * List categories with pagination, filters, and sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['name', 'status'];
        $sortable = ['name', 'status'];

        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $query = ReportCategory::select(
            'id',
            'uuid',
            'name',
            'status',
        );

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {

                    $q->orWhere($column, 'LIKE', '%' . strtolower($searchTerm) . '%');
                }
            });
        }


        $query->orderBy("report_categories.$sortBy", $sortOrder);


        return $perPage && (int) $perPage > 0
            ? $query->paginate((int) $perPage)
            : $query->get();
    }

    /**
     * Store a new category.
     */
    public function store(ReportCategoryRequest $request)
    {
        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "created_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
        ]);

        $category = ReportCategory::create($request->only([
            "name",
            "status",
            "created_by",
            "updated_by",
        ]));

        return new ReportCategoryResource($category);
    }

    public function show(ReportCategory $report_category)
    {
        return ['report_category' => new ReportCategoryResource($report_category)];
    }

    public function update(ReportCategoryRequest $request, ReportCategory $report_category)
    {
        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "updated_by" => Auth::user()?->uuid,
        ]);

        $report_category->fill($request->only([
            'name',
            'status',
            'updated_by',
        ]))->save();

        return new ReportCategoryResource($report_category);
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
                $deleted = ReportCategory::whereIn('id', $ids)->delete();
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
