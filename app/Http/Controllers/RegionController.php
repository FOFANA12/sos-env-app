<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegionRequest;
use App\Http\Resources\RegionResource;
use App\Repositories\RegionRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class RegionController extends Controller
{
    use ApiResponse;
    
    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(RegionRepository $repository)
    {
        $this->messageSuccessCreated = __('app/region.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/region.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the regions.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, RegionResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, RegionResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created region.
     */
    public function store(RegionRequest $request)
    {
        $region = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'region' => $region])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified region.
     */
    public function show(Region $region)
    {
        return response()->json($this->repository->show($region))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified region.
     */
    public function update(RegionRequest $request, Region $region)
    {
        $updatedRegion = $this->repository->update($request, $region);
        return response()->json(['message' => $this->messageSuccessUpdated, 'region' => $updatedRegion])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified region.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
