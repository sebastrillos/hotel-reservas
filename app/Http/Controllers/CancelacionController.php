<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancelacion;

class CancelacionController extends Controller
{
    public function index()
    {
        $cancelaciones = Cancelacion::all();

        return view(
            'cancelaciones.index',
            compact('cancelaciones')
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        $cancelacion = Cancelacion::findOrFail($id);

        $cancelacion->delete();

        return redirect()
            ->route('cancelaciones.index')
            ->with(
                'success',
                'Cancelación eliminada correctamente'
            );
    }

    public function cambiarEstado($id)
    {
        $cancelacion = Cancelacion::findOrFail($id);

        if($cancelacion->estado == 1)
        {
            $cancelacion->estado = 0;
        }
        else
        {
            $cancelacion->estado = 1;
        }

        $cancelacion->save();

        return redirect()
            ->route('cancelaciones.index')
            ->with(
                'success',
                'Estado actualizado correctamente'
            );
    }
}
