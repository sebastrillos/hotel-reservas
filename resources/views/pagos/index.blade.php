@extends('layouts.app')

@section('title', 'Control de Caja y Pagos')

@section('content')
    <div class="content-wrapper">
        <!-- Cabecera -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"><i class="fas fa-dollar-sign text-success mr-2"></i>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('pagos.create') }}" class="btn btn-success btn-flat shadow-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Registrar Recibo de Pago
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido -->
        <section class="content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="icon fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-outline card-success shadow">
                    <div class="card-header bg-white">
                        <h3 class="card-title text-muted">Historial de Ingresos Económicos</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped m-0 valign-middle">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Recibo ID</th>
                                    <th>Reserva Ref.</th>
                                    <th>Huésped / Cliente</th>
                                    <th>Monto Recibido</th>
                                    <th class="text-center">Método de Pago</th>
                                    <th>Fecha de Transacción</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($pagos as $pago)
                                    <tr>
                                        <td class="font-weight-bold text-success">#PAGO-{{ $pago->id }}</td>
                                        <td><span class="badge badge-secondary p-2">#RES-{{ $pago->reserva_id }}</span></td>
                                        <td>
                                            <i class="fas fa-user text-muted mr-1"></i>
                                            {{ $pago->reserva && $pago->reserva->cliente ? $pago->reserva->cliente->nombre : 'Cliente no registrado' }}
                                        </td>
                                        <td class="font-weight-bold text-dark">
                                            ${{ number_format($pago->monto, 2) }}
                                        </td>
                                        <td class="text-center">
                                            @if($pago->metodo_pago == 'efectivo')
                                                <span class="badge badge-success p-2"><i class="fas fa-money-bill-wave mr-1"></i> Efectivo</span>
                                            @elseif($pago->metodo_pago == 'tarjeta')
                                                <span class="badge badge-info p-2"><i class="fas fa-credit-card mr-1"></i> Tarjeta</span>
                                            @else
                                                <span class="badge badge-primary p-2"><i class="fas fa-university mr-1"></i> Transferencia</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y h:i A') }}</td>
                                        <td class="text-center">
                                            <!-- Botón de Factura Ejecutiva -->
                                            <a href="{{ route('pagos.factura', $pago->id) }}" target="_blank" class="btn btn-sm btn-outline-primary btn-flat mr-1" title="Ver Factura">
                                                <i class="fas fa-print mr-1"></i> Factura
                                            </a>

                                            <!-- Botón de Editar -->
                                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-outline-warning btn-flat mr-1" title="Editar Registro">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Botón de Eliminar -->
                                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este recibo de pago?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-flat" title="Eliminar Transacción">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fas fa-cash-register fa-3x mb-3 text-gray" style="opacity: 0.5;"></i>
                                            <p class="h5">No se registran movimientos de caja el día de hoy.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
