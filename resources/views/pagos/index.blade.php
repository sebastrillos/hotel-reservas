@extends('layouts.app')

@section('content')

    <div class="content-wrapper p-3">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h1>Pagos</h1>

            <a href="{{ route('pagos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
            </a>

        </div>

        <div class="card">

            <div class="card-header bg-secondary">
                <h3 class="card-title">Listado De Pagos</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Método</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach ($pagos as $pago)
                        <tr>

                            <td>{{ $pago->id }}</td>

                            <td>{{ $pago->reserva->cliente->nombre ?? 'Sin cliente' }}</td>

                            <td>${{ number_format($pago->monto) }}</td>

                            <td>{{ ucfirst($pago->metodo_pago) }}</td>

                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>

                            <td>

                                <form action="{{ route('pagos.estado', $pago->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    @if($pago->estado == 1)

                                        <button class="btn btn-secondary btn-sm">
                                            Desactivar
                                        </button>

                                    @else

                                        <button class="btn btn-success btn-sm">
                                            Activar
                                        </button>

                                    @endif

                                </form>

                                <form action="{{ route('pagos.destroy', $pago->id) }}"
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
