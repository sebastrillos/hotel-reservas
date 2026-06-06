@extends('layouts.app')

@section('title', 'Anular Orden de Hospedaje')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-calendar-minus text-danger mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('cancelaciones.index') }}" class="btn btn-secondary btn-flat shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver a Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <h5><i class="icon fas fa-ban mr-2"></i> Error en los datos</h5>
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

                <div class="card card-outline card-danger shadow-lg">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Formulario de Baja Operativa</h3>
                    </div>

                    <form action="{{ route('cancelaciones.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                {{-- SELECTOR DE RESERVAS ACTIVAS --}}
                                <div class="col-md-6 form-group">
                                    <label for="reserva_id"><i class="fas fa-key mr-1 text-secondary"></i> Seleccionar Reservación Vigente</label>
                                    <select name="reserva_id" id="reserva_id" class="form-control custom-select" required>
                                        @if($reservaciones->isEmpty())
                                            <option value="" disabled selected>⚠️ No existen reservas activas en este momento</option>
                                        @else
                                            <option value="" disabled selected>-- Selecciona la reserva a dar de baja --</option>
                                            @foreach($reservaciones as $reserva)
                                                <option value="{{ $reserva->id }}" {{ old('reserva_id') == $reserva->id ? 'selected' : '' }}>
                                                    Reserva #{{ $reserva->id }} — {{ $reserva->cliente ? $reserva->cliente->nombre : 'S/N' }} (Hab: #{{ $reserva->habitacion ? $reserva->habitacion->numero : '?' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{-- MOTIVO DE LA CANCELACIÓN --}}
                                <div class="col-md-6 form-group">
                                    <label for="motivo"><i class="fas fa-comment-dots mr-1 text-secondary"></i> Justificación o Motivo del Cliente</label>
                                    <input type="text" name="motivo" id="motivo" class="form-control" placeholder="Ej: Emergencia médica familiar / Cambio de itinerario" value="{{ old('motivo') }}" required>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-light text-right">
                            <a href="{{ route('cancelaciones.index') }}" class="btn btn-default btn-flat">Cancelar</a>
                            <button type="submit" class="btn btn-danger btn-flat font-weight-bold shadow-sm" {{ $reservaciones->isEmpty() ? 'disabled' : '' }}>
                                <i class="fas fa-check mr-1"></i> Confirmar y Liberar Habitación
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
