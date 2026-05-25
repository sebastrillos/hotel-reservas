<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{

    public function index()
    {
        $habitaciones = Habitacion::all();

        return view('habitaciones.index', compact('habitaciones'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);

        foreach($habitacion->reservas as $reserva)
        {
            // Eliminar pagos
            $reserva->pagos()->delete();

            // Eliminar cancelaciones
            $reserva->cancelaciones()->delete();

            // Eliminar reserva
            $reserva->delete();
        }

        // Eliminar habitación
        $habitacion->delete();

        return redirect()
            ->route('habitaciones.index')
            ->with(
                'success',
                'Habitación eliminada correctamente'
            );
    }

    public function habitaciones()
{
    return $this->hasMany(Habitacion::class, 'tipo_id');
}

    public function cambiarEstado($id)
    {
        $habitacion = Habitacion::findOrFail($id);

        $habitacion->estado = !$habitacion->estado;

        $habitacion->save();

        return redirect()
            ->route('habitaciones.index')
            ->with(
                'success',
                'Estado actualizado correctamente'
            );
    }
}
