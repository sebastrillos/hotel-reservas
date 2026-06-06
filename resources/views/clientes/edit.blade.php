@extends('layouts.app')

@section('title', 'Editar Datos del Cliente')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        {{-- Alertas de Validación --}}
        @if($errors->any())
            <div class="alert alert-danger mx-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title" style="margin:0;">@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Documento de Identidad <strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="documento" value="{{ old('documento', $cliente->documento) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre Completo <strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Teléfono de Contacto</label>
                                                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Correo Electrónico</label>
                                                <input type="email" class="form-control" name="correo" value="{{ old('correo', $cliente->correo) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-flat">Actualizar Cliente</button>
                                    <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-flat">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
