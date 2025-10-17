<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {

        // });

        $this->renderable(function (Throwable $e, $request) {

            // Handle missing model (like Project not found)
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Resource not found.',
                ], 404);
            }

            // Handle 404 routes
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Not found.',
                ], 404);
            }

            // Handle unauthenticated access
            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'message' => 'Unauthenticated. Please log in first.',
                ], 401);
            }

            // Handle all other errors (optional)
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Something went wrong. Please try again later.',
                    'error' => $e->getMessage(), // you can hide this in production
                ], 500);
            }
        });
    }
}
