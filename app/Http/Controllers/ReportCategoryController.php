<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportCategoryRequest;
use App\Http\Resources\ReportCategoryResource;
use App\Models\ReportCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ReportCategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportCategoryController extends Controller
{
    use ApiResponse;

    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(ReportCategoryRepository $repository)
    {
        $this->messageSuccessCreated = __('app/report_category.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/report_category.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, ReportCategoryResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, ReportCategoryResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created category.
     */
    public function store(ReportCategoryRequest $request)
    {
        $reportCategory = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'report_category' => $reportCategory])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified category.
     */
    public function show(ReportCategory $report_category)
    {
        return response()->json($this->repository->show($report_category))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified category.
     */
    public function update(ReportCategoryRequest $request, ReportCategory $report_category)
    {
        $reportCategory = $this->repository->update($request, $report_category);
        return response()->json(['message' => $this->messageSuccessUpdated, 'report_category' => $reportCategory])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
