@extends('layouts.app')

@section('title', 'Control de Clientes')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        {{-- Notificaciones de Éxito --}}
        @if(session('success'))
            <div class="alert alert-success mx-4">
                {{ session('success') }}
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                                <h3 class="card-title" style="margin:0; display: inline-block;">@yield('title')</h3>
                                <a href="{{ route('clientes.create') }}" class="btn btn-success btn-sm float-right btn-flat">
                                    <i class="fas fa-plus"></i> Registrar Cliente
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered m-0">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Documento / Identificación</th>
                                        <th>Nombre Completo</th>
                                        <th>Teléfono</th>
                                        <th>Correo Electrónico</th>
                                        <th style="width: 200px">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($clientes as $cliente)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $cliente->documento }}</strong></td>
                                            <td>{{ $cliente->nombre }}</td>
                                            <td>{{ $cliente->telefono ?? 'No registrado' }}</td>
                                            <td>{{ $cliente->correo ?? 'No registrado' }}</td>
                                            <td>
                                                {{-- Botón Ver Detalles --}}
                                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm btn-flat" title="Ver Detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Botón Editar --}}
                                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm btn-flat" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Botón Eliminar con confirmación --}}
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este cliente?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-flat" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No hay clientes registrados en el sistema.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
