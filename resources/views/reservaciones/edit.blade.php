@extends('layouts.app')

@section('title', 'Modificar Reservación')

@section('content')
    <div class="content-wrapper">
        <!-- Cabecera de la Página -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-edit text-warning mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary btn-flat shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Formulario -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-outline card-warning shadow-lg">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Editar datos de la Orden #{{ $reservacion->id }}</h3>
                    </div>

                    <!-- Formulario conectado a tu método update -->
                    <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                {{-- SELECCIÓN DE HUÉSPED --}}
                                <div class="col-md-6 form-group">
                                    <label for="cliente_id"><i class="fas fa-user mr-1 text-secondary"></i> Huésped / Cliente</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control custom-select" required>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ $reservacion->cliente_id == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- SELECCIÓN DE HABITACIÓN --}}
                                <div class="col-md-6 form-group">
                                    <label for="habitacion_id"><i class="fas fa-bed mr-1 text-secondary"></i> Habitación Asignada</label>
                                    <select name="habitacion_id" id="habitacion_id" class="form-control custom-select" required>
                                        @foreach($habitaciones as $habitacion)
                                            <option value="{{ $habitacion->id }}" {{ $reservacion->habitacion_id == $habitacion->id ? 'selected' : '' }}>
                                                Número: {{ $habitacion->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- FECHA DE ENTRADA (CHECK-IN) --}}
                                <div class="col-md-6 form-group">
                                    <label for="fecha_entrada"><i class="fas fa-calendar-plus mr-1 text-secondary"></i> Fecha de Entrada</label>
                                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" value="{{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('Y-m-d') }}" required>
                                </div>

                                {{-- FECHA DE SALIDA (CHECK-OUT) --}}
                                <div class="col-md-6 form-group">
                                    <label for="fecha_salida"><i class="fas fa-calendar-minus mr-1 text-secondary"></i> Fecha de Salida</label>
                                    <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('Y-m-d') }}" required>
                                </div>

                                {{-- ESTADO DE LA RESERVA --}}
                                <div class="col-md-12 form-group">
                                    <label for="estado"><i class="fas fa-toggle-on mr-1 text-secondary"></i> Estado Inicial de Operación</label>
                                    <select name="estado" id="estado" class="form-control custom-select" required>
                                        <option value="pendiente" {{ $reservacion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente (En Espera)</option>
                                        <option value="confirmada" {{ $reservacion->estado == 'confirmada' ? 'selected' : '' }}>Confirmada (Aprobada)</option>
                                        <option value="cancelada" {{ $reservacion->estado == 'cancelada' ? 'selected' : '' }}>Cancelada (Anulada)</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="card-footer bg-light text-right">
                            <a href="{{ route('reservaciones.index') }}" class="btn btn-default btn-flat">Cancelar</a>
                            <button type="submit" class="btn btn-warning btn-flat font-weight-bold text-dark shadow-sm">
                                <i class="fas fa-save mr-1"></i> Actualizar Reservación
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
