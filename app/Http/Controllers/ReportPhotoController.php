<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportPhotoRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ReportPhotoResource;
use App\Models\ReportPhoto;
use App\Repositories\ReportPhotoRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportPhotoController extends Controller
{
    use ApiResponse;

    private $messageSuccessCreated;
    private $messageSuccessUpdated;
    private $messageSuccessDeleted;
    private $repository;

    public function __construct(ReportPhotoRepository $repository)
    {
        $this->messageSuccessCreated = __('app/report_photo.controller.message_success_created');
        $this->messageSuccessUpdated = __('app/report_photo.controller.message_success_updated');
        $this->messageSuccessDeleted = __('app/common.controller.message_success_deleted');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the report photo.
     */
    public function index(Request $request)
    {

        $result = $this->repository->index($request);
        if ($result instanceof LengthAwarePaginator) {
            return $this->respondWithPagination($result, ReportPhotoResource::class)->setStatusCode(Response::HTTP_OK);
        }

        return $this->respondWithCollection($result, ReportPhotoResource::class)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Requirements data for report photo.
     */
    public function requirements()
    {
        return response()->json($this->repository->requirements())->setStatusCode(Response::HTTP_OK);
    }
    
    /**
     * Store a newly created report photo.
     */
    public function store(ReportPhotoRequest $request)
    {
        $reportPhoto = $this->repository->store($request);
        return response()->json(['message' => $this->messageSuccessCreated, 'report_photo' => $reportPhoto])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified report photo.
     */
    public function show(ReportPhoto $report_photo)
    {
        return response()->json($this->repository->show($report_photo))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified report photo.
     */
    public function update(ReportPhotoRequest $request, ReportPhoto $report_photo)
    {
        $reportPhoto = $this->repository->update($request, $report_photo);
        return response()->json(['message' => $this->messageSuccessUpdated, 'report_photo' => $reportPhoto])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove one or multiple report photos.
     */
    public function destroy(Request $request)
    {
        $this->repository->destroy($request);
        return response()->json(['message' => $this->messageSuccessDeleted])->setStatusCode(Response::HTTP_OK);
    }
}
