<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\TipoHabitacion;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usamos eager loading (with) para traer el tipo de habitación de forma eficiente
        $habitaciones = Habitacion::with('tipoHabitacion')->get();

        return view('habitaciones.index', compact('habitaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtenemos todos los tipos de habitación para enviarlos al select de la vista
        $tipos = TipoHabitacion::all();

        return view('habitaciones.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // CORRECCIÓN: Se cambia 'exists:tipohabitaciones,id' por 'exists:tipo_habitacion,id'
        $request->validate([
            'tipo_id'       => 'required|exists:tipo_habitacion,id',
            'numero'        => 'required|integer|unique:habitaciones,numero',
            'piso'          => 'required|integer|min:1',
            'capacidad'     => 'required|integer|min:1',
            'descripcion'   => 'nullable|string',
            'estado'        => 'required|in:disponible,ocupado',
        ]);

        Habitacion::create([
            'tipo_id'       => $request->tipo_id,
            'numero'        => $request->numero,
            'piso'          => $request->piso,
            'capacidad'     => $request->capacidad,
            'descripcion'   => $request->descripcion,
            'estado'        => $request->estado,
            'imagen'        => 'habitacion.jpg',
            'registradopor' => 'admin',
        ]);

        return redirect()->route('habitaciones.index')
            ->with('success', 'La habitación se ha registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $habitacion = Habitacion::with('tipoHabitacion')->findOrFail($id);
        return view('habitaciones.show', compact('habitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $tipos = TipoHabitacion::all();
        return view('habitaciones.edit', compact('habitacion', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // CORRECCIÓN: Se cambia 'exists:tipohabitaciones,id' por 'exists:tipo_habitacion,id'
        $request->validate([
            'tipo_id'       => 'required|exists:tipo_habitacion,id',
            'numero'        => 'required|integer|unique:habitaciones,numero,' . $id,
            'piso'          => 'required|integer|min:1',
            'capacidad'     => 'required|integer|min:1',
            'descripcion'   => 'nullable|string',
            'estado'        => 'required|in:disponible,ocupado',
        ]);

        $habitacion = Habitacion::findOrFail($id);
        $habitacion->update([
            'tipo_id'     => $request->tipo_id,
            'numero'      => $request->numero,
            'piso'        => $request->piso,
            'capacidad'   => $request->capacidad,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado,
        ]);

        return redirect()->route('habitaciones.index')
            ->with('success', 'Habitación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);

        foreach($habitacion->reservas as $reserva)
        {
            // Eliminar pagos relacionados
            $reserva->pagos()->delete();

            // Eliminar cancelaciones relacionadas
            $reserva->cancelaciones()->delete();

            // Eliminar reserva
            $reserva->delete();
        }

        // Eliminar habitación
        $habitacion->delete();

        return redirect()
            ->route('habitaciones.index')
            ->with('success', 'Habitación eliminada correctamente');
    }

    public function cambiarEstado($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        // Intercambiar estados de texto o booleanos según tu migración.
        // Si en la base de datos es string ('disponible' / 'ocupado'):
        $habitacion->estado = ($habitacion->estado == 'disponible') ? 'ocupado' : 'disponible';
        $habitacion->save();

        return redirect()->back()->with('success', 'Estado de la habitación actualizado.');
    }
}
