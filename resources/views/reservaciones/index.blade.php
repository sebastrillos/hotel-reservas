@extends('layouts.app')

@section('content')
    <div class="content-wrapper p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Reservaciones</h1>
            <a href="{{ route('reservaciones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Reservación
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title mb-0">Listado De Reservaciones</h3>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th>Cliente</th>
                            <th class="text-center" style="width: 100px;">Habitación</th>
                            <th class="text-center" style="width: 100px;">Entrada</th>
                            <th class="text-center" style="width: 100px;">Salida</th>
                            <th class="text-end" style="width: 110px;">Total</th>
                            <th class="text-center" style="width: 120px;">Estado</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($reservaciones as $reservacion)
                            <tr>
                                <td class="text-center align-middle">{{ $reservacion->id }}</td>
                                <td class="align-middle">{{ $reservacion->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td class="text-center align-middle">{{ $reservacion->habitacion->numero ?? '-' }}</td>
                                <td class="text-center align-middle">
                                    {{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('d/m/Y') }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('d/m/Y') }}
                                </td>
                                <td class="text-end align-middle">${{ number_format($reservacion->total, 0, ',', '.') }}</td>

                                <!-- CORRECCIÓN: El formulario ahora vive dentro de un <td> -->
                                <td class="text-center align-middle">
                                    <form action="{{ route('reservaciones.estado', $reservacion->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if($reservacion->estado == 'pendiente')
                                            <button type="submit" class="btn btn-warning btn-sm w-100">Confirmar</button>
                                        @elseif($reservacion->estado == 'confirmada')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">Cancelar</button>
                                        @elseif($reservacion->estado == 'cancelada')
                                            <button type="submit" class="btn btn-secondary btn-sm w-100">Pendiente</button>
                                        @endif
                                    </form>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="btn btn-info btn-sm text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('reservaciones.destroy', $reservacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No hay reservaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
