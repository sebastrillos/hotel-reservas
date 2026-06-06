<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Muestra el listado general de reservaciones.
     */
    public function index()
    {
        $reservaciones = Reserva::with('cliente', 'habitacion')->get();

        return view('reservaciones.index', compact('reservaciones'));
    }

    /**
     * Muestra el formulario cargando ÚNICAMENTE habitaciones disponibles.
     */
    public function create()
    {
        $clientes = Cliente::all();

        $habitaciones = Habitacion::where('estado', 'disponible')
            ->orWhere('estado', 'Disponible')
            ->get();

        return view('reservaciones.create', compact('clientes', 'habitaciones'));
    }

    /**
     * Almacena una nueva reserva calculando el total automáticamente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'    => 'required|exists:clientes,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida'  => 'required|date|after_or_equal:fecha_entrada',
            'num_huespedes' => 'required|integer|min:1',
        ]);

        // 1. Calcular los días de estancia usando Carbon
        $entrada = Carbon::parse($request->fecha_entrada);
        $salida = Carbon::parse($request->fecha_salida);
        $dias = $entrada->diffInDays($salida);
        if ($dias == 0) { $dias = 1; } // Si entra y sale el mismo día, se cobra mínimo 1 noche

        // 2. Obtener el precio de la habitación asignada
        $habitacion = Habitacion::findOrFail($request->habitacion_id);

        // REGLA AUTOMÁTICA: total = dias * precio de la habitación
        // (Nota: Si tu columna en la tabla habitaciones se llama 'precio_noche' o similar, cámbiala aquí)
        $totalCalculado = $dias * $habitacion->precio;

        // 3. Guardar el registro completo
        $reservacion = new Reserva();
        $reservacion->cliente_id    = $request->cliente_id;
        $reservacion->habitacion_id = $request->habitacion_id;
        $reservacion->fecha_entrada = $request->fecha_entrada;
        $reservacion->fecha_salida  = $request->fecha_salida;
        $reservacion->num_huespedes = $request->num_huespedes;
        $reservacion->total         = $totalCalculado; // Pasamos el total calculado automáticamente
        $reservacion->estado        = 'pendiente';

        $reservacion->save();

        return redirect()
            ->route('reservaciones.index')
            ->with('success', 'Reservación creada exitosamente con un total de $' . number_format($totalCalculado, 2));
    }

    /**
     * Muestra los detalles de una reserva específica.
     */
    public function show(string $id)
    {
        // Puede quedar vacío
    }

    /**
     * Muestra el formulario para editar una reserva existente.
     */
    public function edit(string $id)
    {
        $reservacion = Reserva::findOrFail($id);
        $clientes = Cliente::all();

        $habitaciones = Habitacion::where('estado', 'disponible')
            ->orWhere('estado', 'Disponible')
            ->orWhere('id', $reservacion->habitacion_id)
            ->get();

        return view('reservaciones.edit', compact('reservacion', 'clientes', 'habitaciones'));
    }

    /**
     * Actualiza los datos recalculando el total en la edición.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cliente_id'    => 'required|exists:clientes,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida'  => 'required|date|after_or_equal:fecha_entrada',
            'num_huespedes' => 'required|integer|min:1',
            'estado'        => 'required|in:pendiente,confirmada,cancelada',
        ]);

        // Recalcular total en caso de que hayan cambiado las fechas o la habitación
        $entrada = Carbon::parse($request->fecha_entrada);
        $salida = Carbon::parse($request->fecha_salida);
        $dias = $entrada->diffInDays($salida);
        if ($dias == 0) { $dias = 1; }

        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        $totalCalculado = $dias * $habitacion->precio;

        $reservacion = Reserva::findOrFail($id);
        $reservacion->cliente_id    = $request->cliente_id;
        $reservacion->habitacion_id = $request->habitacion_id;
        $reservacion->fecha_entrada = $request->fecha_entrada;
        $reservacion->fecha_salida  = $request->fecha_salida;
        $reservacion->num_huespedes = $request->num_huespedes;
        $reservacion->total         = $totalCalculado; // Actualizamos el total automático
        $reservacion->estado        = $request->estado;

        $reservacion->save();

        return redirect()
            ->route('reservaciones.index')
            ->with('success', 'Reservación actualizada correctamente.');
    }

    /**
     * Elimina la reserva y sus registros asociados en cascada.
     */
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);

        $reserva->pagos()->delete();
        $reserva->cancelaciones()->delete();
        $reserva->delete();

        return redirect()
            ->route('reservaciones.index')
            ->with('success', 'Reserva eliminada correctamente');
    }

    /**
     * Cambia de manera cíclica el estado del registro.
     */
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
                $reservacion->pendiente = 'pendiente';
                break;
        }

        $reservacion->save();

        return redirect()
            ->route('reservaciones.index')
            ->with('success', 'Estado actualizado correctamente');
    }
}
