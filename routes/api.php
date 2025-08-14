<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportCategoryController;
use Illuminate\Support\Facades\Route;

// regions
Route::prefix('regions')->controller(RegionController::class)->group(function () {
    Route::post('destroy', 'destroy');
});
Route::apiResource('regions', RegionController::class)->only(['index', 'store', 'show', 'update']);

// departments
Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
    Route::get('requirements', 'requirements');
    Route::post('destroy', 'destroy');
});
Route::apiResource('departments', DepartmentController::class)->only(['index', 'store', 'show', 'update']);

// neighborhoods
Route::prefix('neighborhoods')->controller(NeighborhoodController::class)->group(function () {
    Route::get('requirements', 'requirements');
    Route::post('destroy', 'destroy');
});
Route::apiResource('neighborhoods', NeighborhoodController::class)->only(['index', 'store', 'show', 'update']);

// categories
Route::prefix('report-categories')->controller(ReportCategoryController::class)->group(function () {
    Route::post('destroy', 'destroy');
});
Route::apiResource('report-categories', ReportCategoryController::class)->only(['index', 'store', 'show', 'update']);
