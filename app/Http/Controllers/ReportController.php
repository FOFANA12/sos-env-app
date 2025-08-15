<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Repositories\ReportRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportController extends Controller
{
    use ApiResponse;

    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->messageSuccessCreated = __('app/report.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/report.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the reports.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, ReportResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, ReportResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Requirements data for report.
     */
    public function requirements()
    {
        return response()->json($this->repository->requirements())->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created report.
     */
    public function store(ReportRequest $request)
    {
        $report = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'report' => $report])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        return response()->json($this->repository->show($report))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified report.
     */
    public function update(ReportRequest $request, Report $report)
    {
        $report = $this->repository->update($request, $report);
        return response()->json(['message' => $this->messageSuccessUpdated, 'report' => $report])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the multiple one or reports.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
