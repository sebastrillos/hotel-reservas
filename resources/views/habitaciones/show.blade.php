@extends('layouts.app')

@section('title', 'Detalles de la Habitación')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card card-outline card-info">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title" style="margin:0;">H-{{ $habitacion->numero }} - @yield('title')</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th style="width: 30%;">Número de Habitación</th>
                                        <td><strong>H-{{ $habitacion->numero }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <td>{{ $habitacion->tipoHabitacion->nombre ?? 'Sin especificar' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio por Noche</th>
                                        <td><span class="text-success font-weight-bold">${{ number_format($habitacion->tipoHabitacion->precio_base ?? 0, 2) }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Piso Ubicado</th>
                                        <td>Piso {{ $habitacion->piso }}</td>
                                    </tr>
                                    <tr>
                                        <th>Capacidad Máxima</th>
                                        <td>{{ $habitacion->capacidad }} Personas</td>
                                    </tr>
                                    <tr>
                                        <th>Estado Actual</th>
                                        <td>
                                            @if($habitacion->estado == 'disponible')
                                                <span class="badge badge-success px-3 py-2">Disponible</span>
                                            @else
                                                <span class="badge badge-danger px-3 py-2">Ocupado</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Descripción</th>
                                        <td>{{ $habitacion->descripcion ?? 'Sin descripción registrada.' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('habitaciones.index') }}" class="btn btn-danger btn-flat">
                                    <i class="fas fa-arrow-left"></i> Volver al Listado
                                </a>
                                <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="btn btn-primary btn-flat float-right">
                                    <i class="fas fa-edit"></i> Editar Datos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
