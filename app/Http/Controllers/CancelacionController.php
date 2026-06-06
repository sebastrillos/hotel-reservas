<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancelacion;
use App\Models\Reserva;
use Carbon\Carbon;

class CancelacionController extends Controller
{
    /**
     * Muestra el historial de cancelaciones del hotel.
     */
    public function index()
    {
        // Traemos las cancelaciones con su reserva, cliente y habitación vinculada
        $cancelaciones = Cancelacion::with(['reserva.cliente', 'reserva.habitacion'])
            ->orderBy('id', 'desc')
            ->get();

        return view('cancelaciones.index', compact('cancelaciones'));
    }

    /**
     * Muestra el formulario para cancelar una reserva activa.
     */
    public function create()
    {
        // Traemos solo las reservaciones que NO estén ya canceladas o terminadas
        $reservaciones = Reserva::with(['cliente', 'habitacion'])
            ->whereNotIn('estado', ['cancelada', 'finalizada'])
            ->get();

        return view('cancelaciones.create', compact('reservaciones'));
    }

    /**
     * Registra la cancelación y libera la habitación automáticamente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'motivo'     => 'required|string|max:255',
        ]);

        // 1. Buscamos la reserva y su habitación vinculada
        $reserva = Reserva::with('habitacion')->findOrFail($request->reserva_id);

        // 2. Creamos el registro de la cancelación
        $cancelacion = new Cancelacion();
        $cancelacion->reserva_id       = $request->reserva_id;
        $cancelacion->motivo           = $request->motivo;
        $cancelacion->fecha_cancelacion = Carbon::now()->format('Y-m-d H:i:s');
        $cancelacion->save();

        // AUTOMATIZACIÓN 1: Cambiar el estado de la reserva a 'cancelada'
        $reserva->estado = 'cancelada';
        $reserva->save();

        // AUTOMATIZACIÓN 2: Cambiar el estado de la habitación a 'disponible' de inmediato
        if ($reserva->habitacion) {
            $reserva->habitacion->estado = 'disponible';
            $reserva->habitacion->save();
        }

        return redirect()
            ->route('cancelaciones.index')
            ->with('success', 'La reservación #' . $reserva->id . ' fue cancelada con éxito y su habitación quedó liberada.');
    }

    /**
     * Formulario para editar el motivo de una cancelación (Auditoría).
     */
    public function edit($id)
    {
        $cancelacion = Cancelacion::findOrFail($id);
        // Traemos todas las reservas para la edición si se requiere reasignar
        $reservaciones = Reserva::with('cliente')->get();

        return view('cancelaciones.edit', compact('cancelacion', 'reservaciones'));
    }

    /**
     * Actualiza el motivo o registro de cancelación.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
            'motivo'     => 'required|string|max:255',
        ]);

        $cancelacion = Cancelacion::findOrFail($id);
        $cancelacion->reserva_id = $request->reserva_id;
        $cancelacion->motivo     = $request->motivo;
        $cancelacion->save();

        return redirect()
            ->route('cancelaciones.index')
            ->with('success', 'Registro de cancelación actualizado correctamente.');
    }

    /**
     * Elimina el registro de cancelación (Revierte o borra de bitácora).
     */
    public function destroy($id)
    {
        $cancelacion = Cancelacion::findOrFail($id);
        $cancelacion->delete();

        return redirect()
            ->route('cancelaciones.index')
            ->with('success', 'Registro de cancelación eliminado del historial.');
    }
}
