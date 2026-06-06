<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/dist/img/logo.jpg')}}" alt="Logo" style="opacity: .8; width:200px; height:70px;">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- PANEL DE CONTROL / DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Panel De Control</p>
                    </a>
                </li>

                {{-- MENÚ DESPLEGABLE PRINCIPAL CON NOMBRE REALISTA --}}
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>Gestión de Operaciones<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- MÓDULO DE CLIENTES / HUÉSPEDES --}}
                        <li class="nav-item">
                            <a href="{{ route('clientes.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Huéspedes / Clientes</p>
                            </a>
                        </li>

                        {{-- CATEGORÍAS DE HABITACIÓN --}}
                        <li class="nav-item">
                            <a href="{{ route('tipohabitaciones.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Tipos de Habitación</p>
                            </a>
                        </li>

                        {{-- INVENTARIO DE HABITACIONES --}}
                        <li class="nav-item">
                            <a href="{{ route('habitaciones.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-bed"></i>
                                <p>Habitaciones</p>
                            </a>
                        </li>

                        {{-- RESERVACIONES Y CHECK-IN --}}
                        <li class="nav-item">
                            <a href="{{ route('reservaciones.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Reservaciones</p>
                            </a>
                        </li>

                        {{-- CAJA Y FACTURACIÓN --}}
                        <li class="nav-item">
                            <a href="{{ route('pagos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>Control de Pagos</p>
                            </a>
                        </li>

                        {{-- ANULACIONES Y CANCELACIONES --}}
                        <li class="nav-item">
                            <a href="{{ route('cancelaciones.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-ban"></i>
                                <p>Cancelaciones</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
