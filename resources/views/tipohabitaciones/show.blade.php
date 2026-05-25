@extends('layouts.app')

@section('title','Ver Datos De La Actividad')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
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
						</div>
						<div class="card-body">
							<div class="panel panel-primary">
								<div class="panel-body">
									<center><div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Estrategia</label>
												<p>{{ $actividad->eje->estrategia->nombre }}</p>
											</div>
										</div>
									</div></center>
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Eje</label>
												<p>{{ $actividad->eje->nombre }} ({{ $actividad->eje->descripcion }})</p>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Actividad</label>
												<p>{{ $actividad->nombre }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Persona</label>
												<p>{{ $actividad->persona->nombre ?? '' }}</p>
											</div>
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Tipo Actividad</label>
												<p>{{ $actividad->tipoactividad->nombre }}</p>
											</div>
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Tipo Participante</label>
												<p>{{ $actividad->tipoparticipante->nombre }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Lugar</label>
												<p>{{ $actividad->lugar }}</p>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Cantidad</label>
												<p>{{ $actividad->cantidad }}</p>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Fecha Inicio</label>
												<p>{{ $actividad->fecha }}</p>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Fecha Fin</label>
												<p>{{ $actividad->fechafin ?? '' }}</p>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Año</label>
												<p>{{ $actividad->anio }}</p>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Semestre</label>
												<p>{{ $actividad->semestre }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Objetivo</label>
												<p>{{ $actividad->objetivo }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Descripción</label>
												<p>{{ $actividad->descripcion }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Impacto</label>
												<p>{{ $actividad->impacto }}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="form-group label-floating">
												<label class="control-label">Resultado</label>
												<p>{{ $actividad->resultado }}</p>
											</div>
										</div>
									</div>
									<div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Evidencias</label>
                                                <div class="row">
                                                    @foreach($actividad->imagenes as $imagen)
                                                        <div class="col-lg-4 col-sm-6 col-md-4 col-xs-12">
                                                            <img src="{{ asset('uploads/evidencias/'.$imagen->nombre) }}" alt="" class="img-fluid" style="max-width: 200x; height: 200px; margin-bottom: 15px;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Población Impactada</label>
                                                <div class="row">
                                                    @foreach($actividad->actividadpoblacionimpactadas->unique('poblacionimpactada_id') as $index => $actividadpoblacionimpactada)
														<div class="col-md-4">
															<p>{{ $actividadpoblacionimpactada->poblacionimpactada->nombre }}</p>
														</div>
														@if (($index + 1) % 3 == 0)
															</div><div class="row">
														@endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-lg-2 col-xs-4">
									<a href="{{ route('actividads.index') }}" class="btn btn-danger btn-block btn-flat">Atras</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
 </div>
@endsection