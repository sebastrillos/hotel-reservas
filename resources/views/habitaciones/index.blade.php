@extends('layouts.app')

@section('title', 'Lista de Habitaciones')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        {{-- Alertas de Éxito --}}
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
                                <a href="{{ route('habitaciones.create') }}" class="btn btn-success btn-sm float-right btn-flat">
                                    <i class="fas fa-plus"></i> Nueva Habitación
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered m-0">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Número</th>
                                        <th>Tipo de Habitación</th>
                                        <th>Piso</th>
                                        <th>Capacidad</th>
                                        <th>Estado</th>
                                        <th style="width: 280px">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($habitaciones as $habitacion)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>H-{{ $habitacion->numero }}</strong></td>
                                            <td>{{ $habitacion->tipoHabitacion->nombre ?? 'Sin Tipo' }}</td>
                                            <td>Piso {{ $habitacion->piso }}</td>
                                            <td>{{ $habitacion->capacidad }} Pers.</td>
                                            <td>
                                                @if($habitacion->estado == 'disponible')
                                                    <span class="badge badge-success px-2 py-1">Disponible</span>
                                                @else
                                                    <span class="badge badge-danger px-2 py-1">Ocupado</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Botón Cambiar Estado --}}
                                                <form action="{{ route('habitaciones.estado', $habitacion->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning btn-sm btn-flat" title="Cambiar Estado">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>

                                                {{-- Botón Ver --}}
                                                <a href="{{ route('habitaciones.show', $habitacion->id) }}" class="btn btn-info btn-sm btn-flat" title="Ver Detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Botón Editar --}}
                                                <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="btn btn-primary btn-sm btn-flat" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Botón Eliminar con confirmación js --}}
                                                <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar esta habitación? Se borrarán sus reservas asociadas.');">
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
                                            <td colspan="7" class="text-center text-muted py-4">No hay habitaciones registradas en el sistema.</td>
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
