<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighborhoodRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\NeighborhoodResource;
use App\Models\Neighborhood;
use App\Repositories\NeighborhoodRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class NeighborhoodController extends Controller
{
    use ApiResponse;

    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(NeighborhoodRepository $repository)
    {
        $this->messageSuccessCreated = __('app/neighborhood.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/neighborhood.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the neighborhoods.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, NeighborhoodResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, NeighborhoodResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Requirements data for neighborhood.
     */
    public function requirements()
    {
        return response()->json($this->repository->requirements())->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created neighborhood.
     */
    public function store(NeighborhoodRequest $request)
    {
        $neighborhood = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'neighborhood' => $neighborhood])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified neighborhood.
     */
    public function show(Neighborhood $neighborhood)
    {
        return response()->json($this->repository->show($neighborhood))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified neighborhood.
     */
    public function update(NeighborhoodRequest $request, Neighborhood $neighborhood)
    {
        $neighborhood = $this->repository->update($request, $neighborhood);
        return response()->json(['message' => $this->messageSuccessUpdated, 'neighborhood' => $neighborhood])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified neighborhood.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
