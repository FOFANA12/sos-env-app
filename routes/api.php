<?php

use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

// regions
Route::prefix('regions')->controller(RegionController::class)->group(function () {
    Route::post('destroy', 'destroy');
});
Route::apiResource('regions', RegionController::class)->only(['index', 'store', 'show', 'update']);
