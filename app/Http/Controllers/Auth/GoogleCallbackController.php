<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\GoogleCallbackRepository;
use Illuminate\Support\Facades\Session;

class GoogleCallbackController extends Controller
{
    private GoogleCallbackRepository $repository;

    public function __construct(GoogleCallbackRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the single callback entry point from Google.
     * It detects whether the user intended to register or login.
     */
    public function googleCallback()
    {
        $action = Session::pull('google_action', 'login');

        return $action === 'register'
            ? $this->registerCallback()
            : $this->loginCallback();
    }

    /**
     * Handle the callback for login via Google.
     */
    private function loginCallback()
    {
        try {
            $this->repository->loginWithGoogle();

            return redirect()
                ->route('home')
                ->with('success', __('app/auth/common.login_success'));
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('login')
                ->with('error', $e->getMessage() ?: __('app/auth/common.failed'));
        }
    }

    /**
     * Handle the callback for registration via Google.
     */
    private function registerCallback()
    {
        try {
            $this->repository->registerWithGoogle();

            return redirect()
                ->route('home')
                ->with('success', __('app/auth/register.controller.message_success'));
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('register')
                ->with('error', $e->getMessage() ?: __('app/auth/common.failed'));
        }
    }
}
