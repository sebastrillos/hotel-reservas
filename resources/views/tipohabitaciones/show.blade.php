@extends('layouts.app')

@section('title', 'Detalles del Tipo de Habitación')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h3>{{ $tipoHabitacion->nombre }}</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Precio Base:</strong> ${{ number_format($tipoHabitacion->precio_base, 2) }}</p>
                                <p><strong>Descripción:</strong> {{ $tipoHabitacion->descripcion ?? 'Sin descripción disponible.' }}</p>
                                <p><strong>Estado:</strong> {{ $tipoHabitacion->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
                                <p><strong>Registrado Por:</strong> {{ $tipoHabitacion->registradopor }}</p>

                                <hr>
                                <h4>Habitaciones de este Tipo</h4>
                                @if($tipoHabitacion->habitaciones->count() > 0)
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Piso</th>
                                            <th>Capacidad</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tipoHabitacion->habitaciones as $hab)
                                            <tr>
                                                <td>{{ $hab->numero }}</td>
                                                <td>{{ $hab->piso }}</td>
                                                <td>{{ $hab->capacidad }} personas</td>
                                                <td>{{ $hab->estado }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted">No hay habitaciones asignadas a este tipo actualmente.</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('tipohabitaciones.index') }}" class="btn btn-danger btn-flat">Atrás</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
