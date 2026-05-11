@extends('layouts.app')

@section('title', 'Tipos De Habitaciones')

@section('content')

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tipos De Habitaciones</h1>
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
                        Listado De Habitaciones
                    </h3>

                    <div class="card-tools">

                        <a href="{{ route('tipohabitaciones.create') }}"
                           class="btn btn-primary btn-sm">

                            <i class="fas fa-plus"></i>

                        </a>

                    </div>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="tabla"
                               class="table table-bordered table-striped">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($tipos as $item)

                                <tr>

                                    <td>{{ $item->id }}</td>

                                    <td>{{ $item->nombre }}</td>

                                    <td>{{ $item->descripcion }}</td>

                                    <td>${{ number_format($item->precio_base) }}</td>

                                    <td>

                                        @if($item->estado == 1)

                                            <span class="badge bg-success">
                                                Activo
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Inactivo
                                            </span>

                                        @endif

                                    </td>

                                    <td class="d-flex gap-1">

                                        {{-- EDITAR --}}
                                        <a href="{{ route('tipohabitaciones.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm">

                                            Editar

                                        </a>

                                        {{-- ESTADO --}}
                                        <form action="{{ route('tipohabitaciones.estado', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                            @if($item->estado == 1)

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
                                        <form action="{{ route('tipohabitaciones.destroy', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Eliminar registro?')">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection