<?php

namespace App\Repositories;

use RuntimeException;
use App\Models\Department;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NeighborhoodRequest;
use App\Http\Resources\NeighborhoodResource;
use App\Models\Region;

class NeighborhoodRepository
{
    /**
     * List neighborhoods with pagination, filters, and sorting.
     */
    public function index(Request $request)
    {
        $searchable = ['name', 'region', 'department'];
        $sortable = ['name', 'region', 'department', 'status'];

        $searchTerm = $request->input('searchTerm');
        $sortByInput = $request->input('sortBy');
        $sortOrderInput = strtolower($request->input('sortOrder', 'desc'));
        $perPage = $request->input('perPage');

        $sortOrder = in_array($sortOrderInput, ['asc', 'desc']) ? $sortOrderInput : 'desc';
        $sortBy = in_array($sortByInput, $sortable) ? $sortByInput : 'id';

        $query = Neighborhood::select(
            'neighborhoods.id',
            'neighborhoods.uuid',
            'neighborhoods.name',
            'neighborhoods.status',
            'departments.name as department',
            'regions.name as region',
        )
            ->join('departments', 'neighborhoods.department_uuid', '=', 'departments.uuid')
            ->join('regions', 'neighborhoods.region_uuid', '=', 'regions.uuid');

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm, $searchable) {
                foreach ($searchable as $column) {
                    if ($column === 'department') {
                        $q->orWhere('departments.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else if ($column === 'region') {
                        $q->orWhere('regions.name', 'LIKE', '%' . strtolower($searchTerm) . '%');
                    } else {
                        $q->orWhere("neighborhoods.$column", 'LIKE', '%' . strtolower($searchTerm) . '%');
                    }
                }
            });
        }

        if ($sortBy === 'department') {
            $query->orderBy('departments.name', $sortOrder);
        } else if ($sortBy === 'region') {
            $query->orderBy('regions.name', $sortOrder);
        } else {
            $query->orderBy("neighborhoods.$sortBy", $sortOrder);
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
        $regions = Region::with(
            ['departments' => function ($query) {
                $query->where('status', true)->select('uuid', 'name', 'region_uuid');
            }]
        )
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->select('uuid', 'name')
            ->get();

        return [
            'regions' => $regions,
        ];
    }

    /**
     * Store a new neighborhood.
     */
    public function store(NeighborhoodRequest $request)
    {

        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "department_uuid" => $request->input('department'),
            "region_uuid" => $request->input('region'),
            "created_by" => Auth::user()?->uuid,
            "updated_by" => Auth::user()?->uuid,
        ]);

        $neighborhood = Neighborhood::create($request->only([
            "name",
            "department_uuid",
            "region_uuid",
            "status",
            "created_by",
            "updated_by",
        ]));

        return new NeighborhoodResource($neighborhood);
    }

    /**
     * Show a specific neighborhood.
     */
    public function show(Neighborhood $neighborhood)
    {
        return ['neighborhood' => new NeighborhoodResource($neighborhood)];
    }

    /**
     * Update an neighborhood.
     */
    public function update(NeighborhoodRequest $request, Neighborhood $neighborhood)
    {
        $request->merge([
            "status" => filter_var($request->input('status'), FILTER_VALIDATE_BOOLEAN),
            "department_uuid" => $request->input('department'),
            "region_uuid" => $request->input('region'),
            "updated_by" => Auth::user()?->uuid,
        ]);

        $neighborhood->fill($request->only([
            'name',
            'department_uuid',
            'region_uuid',
            'status',
            'updated_by',
        ]))->save();

        return new NeighborhoodResource($neighborhood);
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
                $deleted = Neighborhood::whereIn('id', $ids)->delete();
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
