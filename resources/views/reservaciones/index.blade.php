@extends('layouts.app')

@section('title', 'Control de Reservas')

@section('content')
    <div class="content-wrapper">
        <!-- Cabecera de la Página -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-calendar-alt text-primary mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('reservaciones.create') }}" class="btn btn-primary btn-flat shadow-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Nueva Reservación
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Principal -->
        <section class="content">
            <div class="container-fluid">

                {{-- Mensajes de Alerta nativos del sistema --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="alert" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-outline card-primary shadow">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Historial General de Ocupación</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped m-0 valign-middle">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Huésped / Cliente</th>
                                    <th>Habitación</th>
                                    <th>Fecha Entrada</th>
                                    <th>Fecha Salida</th>
                                    <th class="text-center">Estado Operativo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- Usamos tu variable exacta del controlador: $reservaciones --}}
                                @forelse($reservaciones as $reservacion)
                                    <tr>
                                        <td class="font-weight-bold text-secondary">#{{ $reservacion->id }}</td>
                                        <td>
                                            <i class="fas fa-user text-muted mr-1"></i>
                                            {{ $reservacion->cliente ? $reservacion->cliente->nombre : 'No asignado' }}
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary p-2">
                                                <i class="fas fa-bed mr-1"></i>
                                                {{ $reservacion->habitacion ? $reservacion->habitacion->numero : 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('d/m/Y') }}</td>

                                        <td class="text-center">
                                            {{-- Control Dinámico basado en tus estados en minúsculas --}}
                                            @if($reservacion->estado == 'confirmada')
                                                <span class="badge badge-success p-2 shadow-sm">Confirmada</span>
                                            @elseif($reservacion->estado == 'pendiente')
                                                <span class="badge badge-warning p-2 text-dark shadow-sm">Pendiente</span>
                                            @elseif($reservacion->estado == 'cancelada')
                                                <span class="badge badge-danger p-2 shadow-sm">Cancelada</span>
                                            @else
                                                <span class="badge badge-secondary p-2 shadow-sm">{{ ucfirst($reservacion->estado) }}</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">

                                                {{-- Botón de cambiar estado --}}
                                                <form action="{{ route('reservaciones.estado', $reservacion->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary btn-flat" title="Rotar Estado (Pendiente -> Confirmada -> Cancelada)">
                                                        <i class="fas fa-sync-alt text-info"></i>
                                                    </button>
                                                </form>

                                                {{-- Botón de editar --}}
                                                <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="btn btn-sm btn-outline-secondary btn-flat" title="Editar Detalles">
                                                    <i class="fas fa-edit text-warning"></i>
                                                </a>

                                                {{-- Botón de eliminar con cascada lógica --}}
                                                <form action="{{ route('reservaciones.destroy', $reservacion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva? Se eliminarán sus pagos y cancelaciones asociadas.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary btn-flat" title="Eliminar por completo">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fas fa-calendar-times fa-3x mb-3 text-gray" style="opacity: 0.5;"></i>
                                            <p class="h5">No se encontraron reservaciones registradas en el sistema.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
