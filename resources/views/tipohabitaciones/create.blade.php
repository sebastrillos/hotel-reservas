@extends('layouts.app')

@section('title', 'Crear Tipo de Habitación')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

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
                                <h3>@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('tipohabitaciones.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre <strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="nombre" placeholder="Ej. Suite Presidencial" value="{{ old('nombre') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Precio Base ($) <strong style="color:red;">(*)</strong></label>
                                                <input type="number" step="0.01" class="form-control" name="precio_base" placeholder="Ej. 150000" value="{{ old('precio_base') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción</label>
                                                <textarea class="form-control" name="descripcion" rows="3" placeholder="Detalles de lo que incluye el tipo de habitación...">{{ old('descripcion') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-flat">Guardar</button>
                                    <a href="{{ route('tipohabitaciones.index') }}" class="btn btn-danger btn-flat">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
