<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png')}}" alt="Logo" style="opacity: .8; width:200px; height:70px;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Panel De Control</p>
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
                                    <p>Tipo Habitación</p>
                                </a>
                            </li>
                      

                            <li class="nav-item">
                                <a href="{{ route('habitaciones.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-bed"></i>
                                    <p>Habitaciones</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('reservaciones.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Reservaciones</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('pagos.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>Pagos</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('cancelaciones.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-times-circle"></i>
                                    <p>Cancelaciones</p>
                                </a>
                            </li>


                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
