@extends('layouts.app')

@section('title', 'Ficha del Cliente')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card card-outline card-info">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title" style="margin:0;">{{ $cliente->nombre }} - @yield('title')</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th style="width: 35%;">Documento / Identificación</th>
                                        <td><strong>{{ $cliente->documento }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Nombre Completo</th>
                                        <td>{{ $cliente->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Teléfono de Contacto</th>
                                        <td>{{ $cliente->telefono ?? 'No registrado' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Correo Electrónico</th>
                                        <td>{{ $cliente->correo ?? 'No registrado' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registrado Por</th>
                                        <td><span class="badge badge-dark px-2 py-1">{{ $cliente->registradopor }}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-flat">
                                    <i class="fas fa-arrow-left"></i> Volver al Listado
                                </a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-flat float-right">
                                    <i class="fas fa-edit"></i> Editar Datos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
