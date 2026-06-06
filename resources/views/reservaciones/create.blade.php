@extends('layouts.app')

@section('title', 'Registrar Nueva Reservación')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-plus-circle text-primary mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary btn-flat shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <h5><i class="icon fas fa-ban mr-2"></i> Por favor, verifica los campos</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-outline card-primary shadow-lg">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Asignación de Huésped e Ingreso</h3>
                    </div>

                    <form action="{{ route('reservaciones.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                {{-- SELECCIÓN DE HUÉSPED --}}
                                <div class="col-md-6 form-group">
                                    <label for="cliente_id"><i class="fas fa-user mr-1 text-secondary"></i> Seleccionar Huésped / Cliente</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control custom-select" required>
                                        <option value="" disabled selected>-- Seleccione un cliente --</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- SELECCIÓN DE HABITACIÓN (MUESTRA EL PRECIO AUTOMÁTICAMENTE) --}}
                                <div class="col-md-6 form-group">
                                    <label for="habitacion_id"><i class="fas fa-bed mr-1 text-secondary"></i> Habitaciones Disponibles</label>
                                    <select name="habitacion_id" id="habitacion_id" class="form-control custom-select" required>
                                        @if($habitaciones->isEmpty())
                                            <option value="" disabled selected>⚠️ No hay habitaciones disponibles actualmente</option>
                                        @else
                                            <option value="" disabled selected>-- Seleccione una habitación libre --</option>
                                            @foreach($habitaciones as $habitacion)
                                                <option value="{{ $habitacion->id }}" {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }}>
                                                    Habitación {{ $habitacion->numero }} — (${{ number_format($habitacion->precio, 0) }} / noche)
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{-- FECHA DE ENTRADA --}}
                                <div class="col-md-6 form-group">
                                    <label for="fecha_entrada"><i class="fas fa-calendar-plus mr-1 text-secondary"></i> Fecha de Entrada (Check-In)</label>
                                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" value="{{ old('fecha_entrada', date('Y-m-d')) }}" required>
                                </div>

                                {{-- FECHA DE SALIDA --}}
                                <div class="col-md-6 form-group">
                                    <label for="fecha_salida"><i class="fas fa-calendar-minus mr-1 text-secondary"></i> Fecha de Salida (Check-Out)</label>
                                    <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{ old('fecha_salida') }}" required>
                                </div>

                                {{-- CANTIDAD DE HUÉSPEDES --}}
                                <div class="col-md-12 form-group">
                                    <label for="num_huespedes"><i class="fas fa-users mr-1 text-secondary"></i> Cantidad de Huéspedes</label>
                                    <input type="number" name="num_huespedes" id="num_huespedes" class="form-control" min="1" max="10" value="{{ old('num_huespedes', 1) }}" required>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-light text-right">
                            <a href="{{ route('reservaciones.index') }}" class="btn btn-default btn-flat">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-flat font-weight-bold shadow-sm" {{ $habitaciones->isEmpty() ? 'disabled' : '' }}>
                                <i class="fas fa-save mr-1"></i> Guardar Reservación
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
