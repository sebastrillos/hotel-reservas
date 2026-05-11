<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class ResourceNotFoundHttpException extends NotFoundHttpException
{
    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }

        return response()->status(404)->view('errors.404', [
            'customMessage' => $this->getMessage() ?: 'La página que buscas no existe.'
        ]);
    }
}