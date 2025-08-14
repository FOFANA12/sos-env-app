<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentController extends Controller
{
   use ApiResponse;
    
    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->messageSuccessCreated = __('app/department.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/department.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the departments.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, DepartmentResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, DepartmentResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created department.
     */
    public function store(DepartmentRequest $request)
    {
        $department = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'department' => $department])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        return response()->json($this->repository->show($department))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified department.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department = $this->repository->update($request, $department);
        return response()->json(['message' => $this->messageSuccessUpdated, 'department' => $department])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
