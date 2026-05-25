<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('reserva.cliente')->get();

        return view('pagos.index', compact('pagos'));
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
        $pago = Pago::findOrFail($id);

        $pago->delete();

        return redirect()
            ->route('pagos.index')
            ->with(
                'success',
                'Pago eliminado correctamente'
            );
    }
    public function cambiarEstado($id)
    {
        $pago = Pago::findOrFail($id);

        if($pago->estado == 1)
        {
            $pago->estado = 0;
        }
        else
        {
            $pago->estado = 1;
        }

        $pago->save();

        return redirect()
            ->route('pagos.index')
            ->with(
                'success',
                'Estado actualizado correctamente'
            );
    }
}
