@extends('layouts.app')

@section('title', 'Historial de Cancelaciones')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-calendar-times text-danger mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('cancelaciones.create') }}" class="btn btn-danger btn-flat shadow-sm">
                            <i class="fas fa-minus-circle mr-1"></i> Procesar Nueva Cancelación
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-outline card-danger shadow">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Bitácora de Reservas Anuladas</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped m-0 valign-middle">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Reserva Ref.</th>
                                    <th>Huésped / Cliente</th>
                                    <th>Habitación</th>
                                    <th>Motivo de Cancelación</th>
                                    <th>Fecha / Hora</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cancelaciones as $cancelacion)
                                    <tr>
                                        <td class="font-weight-bold text-danger">#CNX-{{ $cancelacion->id }}</td>
                                        <td><span class="badge badge-secondary p-2">#RES-{{ $cancelacion->reserva_id }}</span></td>
                                        <td>
                                            <i class="fas fa-user text-muted mr-1"></i>
                                            {{ $cancelacion->reserva && $cancelacion->reserva->cliente ? $cancelacion->reserva->cliente->nombre : 'N/A' }}
                                        </td>
                                        <td>
                                            <span class="badge badge-dark">
                                                Hab. {{ $cancelacion->reserva && $cancelacion->reserva->habitacion ? $cancelacion->reserva->habitacion->numero : 'S/N' }}
                                            </span>
                                        </td>
                                        <td class="text-muted italic">
                                            "{{ $cancelacion->motivo }}"
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($cancelacion->fecha_cancelacion)->format('d/m/Y h:i A') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('cancelaciones.edit', $cancelacion->id) }}" class="btn btn-sm btn-outline-warning btn-flat mr-1" title="Editar Motivo">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('cancelaciones.destroy', $cancelacion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar esta cancelación del registro histórico?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-flat" title="Borrar Registro">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fas fa-calendar-check fa-3x mb-3 text-gray" style="opacity: 0.4;"></i>
                                            <p class="h5">No se registran cancelaciones en el sistema. ¡Excelente estado operativo!</p>
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
