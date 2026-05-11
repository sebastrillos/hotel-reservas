<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $levels = [];
    protected $dontReport = [];
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Si el error es un 404, usamos TU clase personalizada
        if ($exception instanceof NotFoundHttpException) {
            $customException = new \App\Exceptions\ResourceNotFoundHttpException($exception->getMessage());
            return $customException->render($request);
        }

        return parent::render($request, $exception);
    }
}