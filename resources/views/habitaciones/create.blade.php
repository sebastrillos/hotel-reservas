
@extends('layouts.app')

@section('title', 'Crear Nueva Habitación')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        {{-- Control de alertas de errores de validación --}}
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
                            <form method="POST" action="{{ route('habitaciones.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        {{-- SELECT DINÁMICO DE TIPOS DE HABITACIÓN --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipo de Habitación <strong style="color:red;">(*)</strong></label>
                                                <select class="form-control" name="tipo_id" required>
                                                    <option value="">-- Seleccione el Tipo --</option>
                                                    @foreach($tipos as $tipo)
                                                        <option value="{{ $tipo->id }}" {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>
                                                            {{ $tipo->nombre }} (${{ number_format($tipo->precio_base, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Número de Habitación <strong style="color:red;">(*)</strong></label>
                                                <input type="number" class="form-control" name="numero" value="{{ old('numero') }}" required placeholder="Ej: 204">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Piso <strong style="color:red;">(*)</strong></label>
                                                <input type="number" class="form-control" name="piso" value="{{ old('piso') }}" required min="1" placeholder="Ej: 2">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Capacidad (Personas) <strong style="color:red;">(*)</strong></label>
                                                <input type="number" class="form-control" name="capacidad" value="{{ old('capacidad') }}" required min="1" placeholder="Ej: 3">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Estado Inicial <strong style="color:red;">(*)</strong></label>
                                                <select class="form-control" name="estado" required>
                                                    <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                                    <option value="ocupado" {{ old('estado') == 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción de la Habitación</label>
                                                <textarea class="form-control" name="descripcion" rows="3" placeholder="Detalles adicionales como vista al mar, aire acondicionado, etc.">{{ old('descripcion') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-flat">Guardar Habitación</button>
                                    <a href="{{ route('habitaciones.index') }}" class="btn btn-danger btn-flat">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
