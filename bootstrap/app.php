<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('api', [
            \App\Http\Middleware\Localization::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });
        // Validation errors (422)
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        });

        // Authentication (401)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        });

        // Model not found (404)
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'message' => 'Resource not found.',
            ], 404);
        });

        //Too many requests (429)
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            $retryAfter = $e->getHeaders()['Retry-After'] ?? 60;

            return response()->json([
                'message' => __('app/throttle.too_many_requests', ['seconds' => $retryAfter]),
                'retry_after' => $retryAfter,
            ], 429);
        });

        // Generic HTTP exceptions (e.g. 403, 404, 500 if thrown explicitly)
        $exceptions->render(function (HttpExceptionInterface $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage() ?: 'HTTP error.',
            ], $e->getStatusCode());
        });

    })->create();
