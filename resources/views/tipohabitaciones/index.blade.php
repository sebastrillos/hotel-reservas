@extends('layouts.app')

@section('title','Listado De Departamentos')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
		<div class="container-fluid">
		</div>
    </section>
	@include('layouts.partial.msg')
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
							@yield('title')

								<a href="{{ route('tipohabitaciones.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>

						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
								<thead class="text-primary">
									<th width="10px">ID</th>
									<th>País</th>
									<th>Departamento</th>
									<th width="60px">Estado</th>
									<th width="90px">Acción</th>
                                </thead>
                                <tbody>
                                @foreach($tipos as $tipo)
                                    <tr>
                                        <td>{{ $tipo->id }}</td>
                                        <td>{{ $tipo->nombre }}</td> {{-- Ajusta según las columnas de tu tabla --}}
                                        <td>{{ $tipo->descripcion }}</td>
                                        <td>
                                            {{-- Badge de estado --}}
                                            <span class="badge {{ $tipo->estado ? 'badge-success' : 'badge-danger' }}">
                {{ $tipo->estado ? 'Activo' : 'Inactivo' }}
            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('tipohabitaciones.edit', $tipo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <form class="d-inline delete-form" action="{{ route('tipohabitaciones.destroy', $tipo) }}"  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
		</div>
    </section>
 </div>
@endsection
