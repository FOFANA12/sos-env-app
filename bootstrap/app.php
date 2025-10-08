<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();

        $middleware->web(prepend: [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\Localization::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'api-auth/*',
            'password/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*');
        });

        // Validation errors (422)
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => __('validation.failed'),
                    'errors'  => $e->errors(),
                ], 422);
            }

            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($e->errors());
        });

        // Authentication (401)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            return redirect()->guest(route('login'));
        });

        // Model not found (404)
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Resource not found.',
                ], 404);
            }

            abort(404);
        });

        // Too many requests (429)
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            $retryAfter = $e->getHeaders()['Retry-After'] ?? 60;

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message'      => __('app/throttle.too_many_requests', ['seconds' => $retryAfter]),
                    'retry_after'  => $retryAfter,
                ], 429);
            }

            return back()->with('error', __('app/throttle.too_many_requests', ['seconds' => $retryAfter]));
        });

        // Generic HTTP exceptions (403, 404 explicite, 500, etc.)
        $exceptions->render(function (HttpExceptionInterface $e, Request $request) {
            $message = $e->getMessage() ?: 'HTTP error.';

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => $message,
                ], $e->getStatusCode());
            }

            $status = $e->getStatusCode();
            $view   = view()->exists("errors.$status") ? "errors.$status" : "errors.default";

            return response()->view($view, ['message' => $message], $status);
        });
    })->create();
