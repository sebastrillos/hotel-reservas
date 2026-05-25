@extends('layouts.app')

@section('content')

<div class="content-wrapper p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Habitaciones</h1>

        <a href="{{ route('habitaciones.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="card">

        <div class="card-header bg-secondary">
            <h3 class="card-title">Listado De Habitaciones</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Número</th>
                        <th>Piso</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($habitaciones as $habitacion)

                    <tr>

                        <td>{{ $habitacion->id }}</td>

                        <td>{{ $habitacion->numero }}</td>

                        <td>{{ $habitacion->piso }}</td>

                        <td>{{ $habitacion->tipo->nombre }}</td>

                        <td>

                            @if($habitacion->estado == 1)

                                <span class="badge bg-success">
                                         Disponible
                                </span>

                            @else

                                <span class="badge bg-danger">
                                        Ocupada
                                </span>

                            @endif

                        </td>

                        <td>

                            <form action="{{ route('habitaciones.estado', $habitacion->id) }}"
                                  method="POST">

                                @csrf
                                @method('PUT')

                                @if($habitacion->estado == 1)

                                    <button class="btn btn-secondary btn-sm">
                                        Desactivar
                                    </button>

                                @else

                                    <button class="btn btn-success btn-sm">
                                        Activar
                                    </button>

                                @endif

                            </form>

                            <form action="{{ route('habitaciones.destroy', $habitacion->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Eliminar
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

@endsection
