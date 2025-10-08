<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\LoginRepository;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    private LoginRepository $repository;

    public function __construct(LoginRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Authenticate the user via API and return a Bearer token.
     */
    public function apiLogin(LoginRequest $request)
    {
        $result = $this->repository->apiLogin($request);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Authenticate the user for SPA (web browser).
     */
    public function spaLogin(LoginRequest $request)
    {
        $result = $this->repository->spaLogin($request);

        return response()->json([...$result, 'message' => __('app/auth/common.login_success')], Response::HTTP_OK);
    }

    /**
     * Log out the user via API and revoke their tokens.
     */
    public function apiLogout()
    {
        $message = $this->repository->apiLogout();

        return response()->json(['message' => $message], Response::HTTP_OK);
    }

    /**
     * Log out the user from SPA (web browser).
     */
    public function spaLogout()
    {
        $message = $this->repository->spaLogout();

        return response()->json(['message' => $message], Response::HTTP_OK);
    }

    /**
     * Redirect the user to the home page after a successful login with a flash success message.
     */
    public function webLoginRedirect()
    {
        return redirect()
            ->route('home')
            ->with('success', __('app/auth/common.login_success'));
    }

    /**
     * Redirect the user to the home page after logout with a flash success message.
     */
    public function webLogoutRedirect()
    {
        return redirect()
            ->route('home')
            ->with('success', __('app/auth/common.logout_success'));
    }
}
