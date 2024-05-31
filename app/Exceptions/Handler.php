<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Not found http'
            ], 404);
        });
    }

    /**
     * Всегда возвращаем JSON
     *
     * @param ValidationException $e
     * @param $request
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request): \Illuminate\Http\Response|JsonResponse|Response
    {
        return $this->invalidJson($request, $e);
    }

    /**
     * Всегда возвращаем JSON
     *
     * @param $request
     * @param AuthenticationException $exception
     * @return JsonResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse|Response
    {
        return response()->json(['message' => $exception->getMessage()], 401);
    }
}
