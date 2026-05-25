@extends('layouts.app')

@section('title', 'Cancelaciones')

@section('content')

    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>Cancelaciones</h1>
                    </div>

                    <div class="col-sm-6 text-right">

                        <a href="{{ route('cancelaciones.create') }}"
                           class="btn btn-primary">

                            <i class="fas fa-plus"></i>
                            Nueva Cancelación

                        </a>

                    </div>

                </div>

            </div>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">

                <div class="card shadow">

                    <div class="card-header bg-secondary">

                        <h3 class="card-title text-white">
                            Listado De Cancelaciones
                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped">

                                <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Reserva</th>
                                    <th>Cliente</th>
                                    <th>Habitación</th>
                                    <th>Motivo</th>
                                    <th>Fecha Cancelación</th>
                                    <th>Registrado Por</th>
                                    <th>Acciones</th>
                                </tr>

                                </thead>

                                <tbody>

                                @forelse($cancelaciones as $cancelacion)

                                    <tr>

                                        <td>
                                            {{ $cancelacion->id }}
                                        </td>

                                        <td>
                                            #{{ $cancelacion->reserva->id ?? 'Sin reserva' }}
                                        </td>

                                        <td>
                                            {{ $cancelacion->reserva->cliente->nombre ?? 'Sin cliente' }}
                                        </td>

                                        <td>
                                            {{ $cancelacion->reserva->habitacion->numero ?? 'Sin habitación' }}
                                        </td>

                                        <td>
                                            {{ $cancelacion->motivo }}
                                        </td>

                                        <td>

                                            @if($cancelacion->fecha_cancelacion)

                                                {{ \Carbon\Carbon::parse($cancelacion->fecha_cancelacion)->format('d/m/Y') }}

                                            @else

                                                Sin fecha

                                            @endif

                                        </td>

                                        <td>
                                            {{ $cancelacion->registradopor }}
                                        </td>

                                        <td class="d-flex gap-1">

                                            <form action="{{ route('cancelaciones.estado', $cancelacion->id) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                @if($cancelacion->estado == 1)

                                                    <button class="btn btn-secondary btn-sm">
                                                        Desactivar
                                                    </button>

                                                @else

                                                    <button class="btn btn-success btn-sm">
                                                        Activar
                                                    </button>

                                                @endif

                                            </form>

                                            {{-- ELIMINAR --}}
                                            <form action="{{ route('cancelaciones.destroy', $cancelacion->id) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Eliminar cancelación?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8"
                                            class="text-center text-muted">

                                            No hay cancelaciones registradas.

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
