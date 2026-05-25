<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index()
    {
        $reservaciones = Reserva::with('cliente', 'habitacion')->get();

        return view('reservaciones.index', compact('reservaciones'));
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
        $reserva = Reserva::findOrFail($id);

        $reserva->pagos()->delete();

        $reserva->cancelaciones()->delete();

        $reserva->delete();

        return redirect()
            ->route('reservaciones.index')
            ->with(
                'success',
                'Reserva eliminada correctamente'
            );
    }

    public function cambiarEstado($id)
    {
        $reservacion = Reserva::findOrFail($id);

        switch($reservacion->estado)
        {
            case 'pendiente':
                $reservacion->estado = 'confirmada';
                break;

            case 'confirmada':
                $reservacion->estado = 'cancelada';
                break;

            case 'cancelada':
                $reservacion->estado = 'pendiente';
                break;
        }

        $reservacion->save();

        return redirect()
            ->route('reservaciones.index')
            ->with(
                'success',
                'Estado actualizado correctamente'
            );
    }
}
