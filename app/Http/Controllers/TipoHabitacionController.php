<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoHabitacion;
use App\Exceptions\ResourceNotFoundHttpException;
use App\Models\Habitacion;


class TipoHabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Obtener todos los tipos de habitaciones de la DB
        // Asegúrate de importar el modelo arriba: use App\Models\TipoHabitacion;
        $tipos = \App\Models\TipoHabitacion::all();

        // 2. Pasar la variable a la vista
        return view('tipohabitaciones.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipohabitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $actividad = TipoHabitacion::with(['habitaciones'])->findOrFail($id);
        return view('tipohabitaciones.show',compact('tipoHabitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

public function destroy($id)
{
    $tipo = TipoHabitacion::findOrFail($id);

    foreach ($tipo->habitaciones as $habitacion)
    {
        foreach ($habitacion->reservas as $reserva)
        {
            // Eliminar cancelaciones
            $reserva->cancelaciones()->delete();

            // Eliminar pagos
            $reserva->pagos()->delete();

            // Eliminar reserva
            $reserva->delete();
        }

        // Eliminar habitación
        $habitacion->delete();
    }

    // Eliminar tipo
    $tipo->delete();

    return redirect()
            ->route('tipohabitaciones.index')
            ->with('success',
            'Todos los registros relacionados fueron eliminados');
}

public function cambiarEstado($id)
{
    $tipo = TipoHabitacion::findOrFail($id);

    $tipo->estado = !$tipo->estado;

    $tipo->save();

    return redirect()->back();
}



public function getRoom($id)
{
    $room = Room::find($id);

    if (!$room) {
        throw new ResourceNotFoundHttpException("La habitación con ID $id no existe en la base de datos.");
    }

    return view('rooms.details', compact('room'));
}
}
