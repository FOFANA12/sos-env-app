<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\RegisterRepository;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    private $messageSuccess;
    private RegisterRepository $repository;

    public function __construct(RegisterRepository $repository)
    {
        $this->repository = $repository;
        $this->messageSuccess = __('app/auth/register.controller.message_success');
    }

    /**
     * Handle user registration.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        return response()->json([
            'message' => $this->messageSuccess,
            'user' => $this->repository->register($request),
        ], Response::HTTP_CREATED);
    }
}
