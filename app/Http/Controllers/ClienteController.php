<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traemos todos los clientes registrados
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos que el documento sea único en la tabla 'clientes'
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|max:20|unique:clientes,documento',
            'telefono'  => 'nullable|string|max:20',
            'correo'    => 'nullable|email|max:255',
        ]);

        Cliente::create([
            'nombre'        => $request->nombre,
            'documento'     => $request->documento,
            'telefono'      => $request->telefono,
            'correo'        => $request->correo,
            'registradopor' => 'admin', // Estándar de auditoría del proyecto
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validamos ignorando el ID actual del cliente para permitir guardar si no cambia el documento
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|max:20|unique:clientes,documento,' . $id,
            'telefono'  => 'nullable|string|max:20',
            'correo'    => 'nullable|email|max:255',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre'    => $request->nombre,
            'documento' => $request->documento,
            'telefono'  => $request->telefono,
            'correo'    => $request->correo,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Datos del cliente actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // El cliente se elimina directamente. Si tiene reservas asociadas,
        // la base de datos controlará la integridad según tus llaves foráneas.
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}
