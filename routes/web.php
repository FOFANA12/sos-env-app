<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', fn() => view('pages/contact'))->name('contact');
Route::get('/privacy', fn() => view('pages/privacy'))->name('privacy');
Route::get('/terms', fn() => view('pages/terms'))->name('terms');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('pages/auth/login'))->name('login');
    Route::get('/register', fn() => view('pages/auth/register'))->name('register');
    Route::get('/forgot-password', fn() => view('pages/auth/forgot-password'))->name('password.request');
    Route::get('/reset-password/{token}/{email}', fn($token, $email) => view('pages/auth/reset-password', [
        'token' => $token,
        'email' => $email,
    ]))->name('password.reset');
    Route::get('/web-logout-redirect', [LoginController::class, 'webLogoutRedirect'])
        ->name('web.logout.redirect');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', fn() => view('pages/profile'))->name('profile');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', fn() => view('pages/user/index'))->name('index');
        Route::get('/create', fn() => view('pages/user/create'))->name('create');
        Route::get('/{user}/edit', fn($user) => view('pages/user/edit', compact('user')))->name('edit');
        Route::get('/{user}', fn($user) => view('pages/user/show', compact('user')))->name('show');
    });

    Route::get('/regions', fn() => view('pages/region'))->name('regions.index');
    Route::get('/departments', fn() => view('pages/department'))->name('departments.index');
    Route::get('/neighborhoods', fn() => view('pages/neighborhood'))->name('neighborhoods.index');

    Route::get('/web-profile-redirect', [ProfileController::class, 'webProfileRedirect'])
        ->name('web.profile.redirect');

    Route::get('/web-login-redirect', [LoginController::class, 'webLoginRedirect'])
        ->name('web.login.redirect');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', fn() => view('pages/report/index'))->name('index');
    Route::get('/create', fn() => view('pages/report/create'))->name('create');
    // Route::get('/{user}/edit', fn($user) => view('pages/user/edit', compact('user')))->name('edit');
    // Route::get('/{user}', fn($user) => view('pages/user/show', compact('user')))->name('show');
});
