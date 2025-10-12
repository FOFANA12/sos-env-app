<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportPhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// API Auth (token based login/logout)
Route::prefix('api-auth')->controller(LoginController::class)->group(function () {
    Route::post('login', 'apiLogin')->middleware('throttle:5,1');
    Route::post('logout', 'apiLogout')->middleware('auth:sanctum');
});

// SPA Auth (session/cookie based login/logout)
Route::prefix('spa-auth')->controller(LoginController::class)->group(function () {
    Route::post('login', 'spaLogin')->middleware('throttle:5,1');
    Route::post('logout', 'spaLogout')->middleware('auth:web');
});

// Register (public)
Route::post('register', [RegisterController::class, 'register'])->middleware('throttle:5,1');

// Profile Management (authenticated user)
Route::middleware('auth:sanctum')->controller(ProfileController::class)->prefix('profile')->group(function () {
    Route::get('/', 'getProfile');
    Route::put('/', 'update');
});

// Password Reset (no auth required)
Route::prefix('password')->group(function () {
    Route::post('forgot', [ForgotPasswordController::class, 'forgetPassword'])->middleware('throttle:3,1');
    Route::post('reset', [ResetPasswordController::class, 'resetPassword'])->middleware('throttle:5,1');
});

// Users
Route::prefix('users')->group(function () {
    Route::get('requirements', [UserController::class, 'requirements']);
    Route::post('destroy', [UserController::class, 'destroy']);
});
Route::apiResource('users', UserController::class)->only(['index', 'store', 'show', 'update']);


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

// reports
Route::prefix('reports')->controller(ReportController::class)->group(function () {
    Route::get('requirements', 'requirements');
    Route::post('destroy', 'destroy');
});
Route::apiResource('reports', ReportController::class)->only(['index', 'store', 'show', 'update']);

// report photos
Route::prefix('report-photos')->controller(ReportPhotoController::class)->group(function () {
    Route::get('requirements', 'requirements');
    Route::post('destroy', 'destroy');
});
Route::apiResource('report-photos', ReportPhotoController::class)->only(['index', 'store', 'show', 'update']);
