@extends('layouts.app')

@section('title','Panel De Control')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    {{-- CUADRO 1: TOTAL CLIENTES EN BASE DE DATOS --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ \App\Models\Cliente::count() }}</h3>
                                <p>Huéspedes Registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('clientes.index') }}" class="small-box-footer">
                                Más Información <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    {{-- CUADRO 2: RESERVACIONES REGISTRADAS --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ \App\Models\Reserva::count() }}</h3>
                                <p>Reservas Activas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <a href="{{ route('reservaciones.index') }}" class="small-box-footer">
                                Ver Detalles <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    {{-- CUADRO 3: INVENTARIO DE HABITACIONES --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ \App\Models\Habitacion::count() }}</h3>
                                <p>Total Habitaciones</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bed"></i>
                            </div>
                            <a href="{{ route('habitaciones.index') }}" class="small-box-footer">
                                Ver Inventario <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    {{-- CUADRO 4: HISTORIAL DE PAGOS --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ \App\Models\Pago::count() }}</h3>
                                <p>Pagos Procesados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="{{ route('pagos.index') }}" class="small-box-footer">
                                Ver Caja <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
