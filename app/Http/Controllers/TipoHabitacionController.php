<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoHabitacion;

class TipoHabitacionController extends Controller
{
    /**
     * Muestra la lista de todos los tipos de habitaciones.
     */
    public function index()
    {
        $tipos = TipoHabitacion::all();
        return view('tipohabitaciones.index', compact('tipos'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo.
     */
    public function create()
    {
        return view('tipohabitaciones.create');
    }

    /**
     * Guarda el nuevo registro en la base de datos con validación.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:tipo_habitacion,nombre',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
        ]);

        TipoHabitacion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio_base' => $request->precio_base,
            'estado' => 1, // Activo por defecto
            'registradopor' => auth()->user()->name ?? 'Sistema'
        ]);

        return redirect()->route('tipohabitaciones.index')
            ->with('success', 'Tipo de habitación creado exitosamente.');
    }

    /**
     * Muestra los detalles de un tipo específico y sus habitaciones relacionadas.
     */
    public function show($id)
    {
        // 1. Buscamos el tipo de habitación por su ID real y cargamos sus habitaciones correspondientes
        $tipoHabitacion = TipoHabitacion::with(['habitaciones'])->findOrFail($id);

        // 2. Lo pasamos a la vista con el nombre de variable correcto
        return view('tipohabitaciones.index', compact('tipoHabitacion'));
    }

    /**
     * Muestra el formulario para editar el registro.
     */
    public function edit($id)
    {
        $tipoHabitacion = TipoHabitacion::findOrFail($id);
        return view('tipohabitaciones.edit', compact('tipoHabitacion'));
    }

    /**
     * Actualiza el registro en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // 1. Validar los datos que vienen del formulario
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio_base' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        // 2. Buscar el registro real en la base de datos
        $tipoHabitacion = TipoHabitacion::findOrFail($id);

        // 3. Actualizar explícitamente TODOS los campos en la base de datos
        $tipoHabitacion->update([
            'nombre'      => $request->nombre,
            'precio_base' => $request->precio_base,
            'descripcion' => $request->descripcion,
        ]);

        // 4. Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('tipohabitaciones.index')
            ->with('success', 'El tipo de habitación se actualizó correctamente con todos sus datos.');
    }

    /**
     * Elimina el registro y todo lo relacionado en cascada para evitar fallos de integridad.
     */
    public function destroy($id)
    {
        $tipo = TipoHabitacion::findOrFail($id);

        foreach ($tipo->habitaciones as $habitacion) {
            foreach ($habitacion->reservas as $reserva) {
                $reserva->cancelaciones()->delete();
                $reserva->pagos()->delete();
                $reserva->delete();
            }
            $habitacion->delete();
        }

        $tipo->delete();

        return redirect()->route('tipohabitaciones.index')
            ->with('success', 'Todos los registros relacionados fueron eliminados correctamente.');
    }

    /**
     * Cambia el estado lógico (Activo/Inactivo).
     */
    public function cambiarEstado($id)
    {
        $tipo = TipoHabitacion::findOrFail($id);
        $tipo->estado = !$tipo->estado;
        $tipo->save();

        return redirect()->back()->with('success', 'Estado modificado correctamente.');
    }
}
