<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
		<img src="{{ asset('backend/dist/img/AdminLTELogo.png')}}" alt="Logo"  style="opacity: .8; width:200px; height:70px;">
    </a>
    <div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="{{ url('/home') }}" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Panel De Control
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-dharmachakra"></i>
						<p>Parámetros<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tipohabitaciones.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-globe"></i>
                                    <p>Tipo habitacion</p>
                                </a>
                            </li>

							<li class="nav-item">
								<a href="{{ route('habitaciones.index') }}" class="nav-link">
									<i class="nav-icon fas fa-map-marker"></i>
									<p>Habitaciones</p>
								</a>
							</li>

						@can('ciudads.index')
							<li class="nav-item">
								<a href="{{ route('ciudads.index') }}" class="nav-link">
									<i class="nav-icon fas fa-map-marker-alt"></i>
									<p>Ciudad</p>
								</a>
							</li>
						@endcan
						@can('tipodocumentos.index')
							<li class="nav-item">
								<a href="{{ route('tipodocumentos.index') }}" class="nav-link">
									<i class="nav-icon fas fa-address-card"></i>
									<p>Tipo Documento</p>
								</a>
							</li>
						@endcan
					</ul>
				</li>
			</ul>
		</nav>
    </div>
</aside>
