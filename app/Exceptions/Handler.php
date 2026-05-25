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
        $this->renderable(function (
            \Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e,
                                                                          $request
        ) {

            return response()->view('errors.404', [], 404);

        });

        $this->renderable(function (
            \Symfony\Component\HttpKernel\Exception\HttpException $e,
                                                                  $request
        ) {

            if($e->getStatusCode() == 403)
            {
                return response()->view('errors.403', [], 403);
            }

            elseif($e->getStatusCode() == 500)
            {
                return response()->view('errors.500', [], 500);
            }

            elseif($e->getStatusCode() == 419)
            {
                return response()->view('errors.419', [], 419);
            }

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
