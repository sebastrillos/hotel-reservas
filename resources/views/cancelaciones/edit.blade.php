@extends('layouts.app')

@section('title', 'Modificar Registro de Cancelación')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-edit text-warning mr-2"></i>@yield('title')</h1>
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
                        <h5><i class="icon fas fa-ban mr-2"></i> Error al actualizar</h5>
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

                <div class="card card-outline card-warning shadow-lg">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Editar Anulación #CNX-{{ $cancelacion->id }}</h3>
                    </div>

                    <form action="{{ route('cancelaciones.update', $cancelacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                {{-- RESERVA SELECCIONADA --}}
                                <div class="col-md-6 form-group">
                                    <label for="reserva_id"><i class="fas fa-key mr-1 text-secondary"></i> Vinculación de Reserva</label>
                                    <select name="reserva_id" id="reserva_id" class="form-control custom-select" required>
                                        @foreach($reservaciones as $reserva)
                                            <option value="{{ $reserva->id }}" {{ old('reserva_id', $cancelacion->reserva_id) == $reserva->id ? 'selected' : '' }}>
                                                Reserva #{{ $reserva->id }} — {{ $reserva->cliente ? $reserva->cliente->nombre : 'S/N' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- MOTIVO DE LA CANCELACIÓN --}}
                                <div class="col-md-6 form-group">
                                    <label for="motivo"><i class="fas fa-comment-dots mr-1 text-secondary"></i> Justificación o Motivo</label>
                                    <input type="text" name="motivo" id="motivo" class="form-control" value="{{ old('motivo', $cancelacion->motivo) }}" required>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-light text-right">
                            <a href="{{ route('cancelaciones.index') }}" class="btn btn-default btn-flat">Cancelar</a>
                            <button type="submit" class="btn btn-warning btn-flat font-weight-bold shadow-sm">
                                <i class="fas fa-sync-alt mr-1"></i> Actualizar Bitácora
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
