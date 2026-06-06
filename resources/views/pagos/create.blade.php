@extends('layouts.app')

@section('title', 'Procesar Recibo de Pago')

@section('content')
    <div class="content-wrapper">
        <!-- Cabecera -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-cash-register text-success mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('pagos.index') }}" class="btn btn-secondary btn-flat shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver a Caja
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <section class="content">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <h5><i class="icon fas fa-ban mr-2"></i> Error en la transacción</h5>
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

                <div class="card card-outline card-success shadow-lg">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Facturación y Cierre de Cuenta</h3>
                    </div>

                    <form action="{{ route('pagos.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                {{-- SELECTOR DE RESERVAS --}}
                                <div class="col-md-6 form-group">
                                    <label for="reserva_id"><i class="fas fa-calendar-check mr-1 text-secondary"></i> Seleccionar Reservación Activa</label>
                                    <select name="reserva_id" id="reserva_id" class="form-control custom-select" required>
                                        @if($reservaciones->isEmpty())
                                            <option value="" disabled selected>⚠️ No hay reservas pendientes de pago</option>
                                        @else
                                            <option value="" disabled selected>-- Elige la orden de hospedaje --</option>
                                            @foreach($reservaciones as $reserva)
                                                <option value="{{ $reserva->id }}" {{ old('reserva_id') == $reserva->id ? 'selected' : '' }}>
                                                    Reserva #{{ $reserva->id }} — {{ $reserva->cliente ? $reserva->cliente->nombre : 'S/N' }} (Monto: ${{ number_format($reserva->total, 2) }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{-- MÉTODO DE PAGO --}}
                                <div class="col-md-6 form-group">
                                    <label for="metodo_pago"><i class="fas fa-wallet mr-1 text-secondary"></i> Modalidad de Liquidación</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-control custom-select" required>
                                        <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo (Caja Chica)</option>
                                        <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta de Crédito / Débito</option>
                                        <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia Bancaria / QR</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="card-footer bg-light text-right">
                            <a href="{{ route('pagos.index') }}" class="btn btn-default btn-flat">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-flat font-weight-bold shadow-sm" {{ $reservaciones->isEmpty() ? 'disabled' : '' }}>
                                <i class="fas fa-receipt mr-1"></i> Registrar e Imprimir Pago
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
