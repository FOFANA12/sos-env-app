<?php

namespace App\Repositories;

use RuntimeException;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegionRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RegionResource;

class RegionRepository
{
    /**
     * List regions with pagination, filters, and sorting.
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
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'regions.id';

        $query = Region::select(
            'regions.id',
            'regions.uuid',
            'regions.name',
            'regions.status',
        );

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {

                    $q->orWhere($column, 'LIKE', '%' . strtolower($searchTerm) . '%');
                }
            });
        }


        $query->orderBy($sortBy, $sortOrder);


        return $perPage && (int) $perPage > 0
            ? $query->paginate((int) $perPage)
            : $query->get();
    }

    /**
     * Store a new regions.
     */
    public function store(RegionRequest $request)
    {
        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "created_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
        ]);

        $region = Region::create($request->only([
            "name",
            "status",
            "created_by",
            "updated_by",
        ]));

        return new RegionResource($region);
    }

    public function show(Region $region)
    {
        return ['region' => new RegionResource($region)];
    }

    public function update(RegionRequest $request, Region $region)
    {
        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "updated_by" => Auth::user()?->uuid,
        ]);

        $region->fill($request->only([
            'name',
            'status',
            'updated_by',
        ]))->save();

        return new RegionResource($region);
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
                $deleted = Region::whereIn('id', $ids)->delete();
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
