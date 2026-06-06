<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Esto tomará el nombre que definas en el archivo .env en APP_NAME --}}
    <title>{{ config('app.name', 'Sistema Hotelero') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* 🎨 Fondo elegante con animación fluida (Azul Marino y Onyx Corporativo) */
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            background-size: 400% 400%;
            animation: gradientMove 12s ease infinite;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.95) !important;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 1rem 2.5rem rgba(0,0,0,0.3) !important;
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #2c5364, #203a43);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-3 fade-in">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-white" href="#">
            <i class="bi bi-building-fill text-warning me-2"></i>
            {{-- Cambia aquí si quieres escribir el nombre directamente, ej: "Hotel Colonial" --}}
            {{ config('app.name', 'Hotel Intranet') }}
        </a>

        @if (Route::has('login'))
            <div class="d-flex gap-2">
                @auth
                    {{-- Redirección al Panel de Control que usa tu Sidebar --}}
                    <a href="{{ url('/home') }}" class="btn btn-light fw-semibold shadow-sm">
                        <i class="bi bi-th-large me-1"></i> Panel de Control
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light px-4">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Gestionar Sistema
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-warning text-dark fw-semibold shadow-sm px-3">
                            <i class="bi bi-person-plus-fill me-1"></i> Registrar Staff
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<div class="container py-5 text-center text-white fade-in">
    <div class="d-flex justify-content-center mb-4">
        <div class="logo-circle shadow-lg text-warning animate-bounce">
            <i class="bi bi-concierge-bell fs-1"></i>
        </div>
    </div>

    <h1 class="display-4 fw-bold mb-3">Plataforma de Gestión Operativa</h1>
    <p class="lead mb-5 opacity-75 max-w-xl mx-auto">
        Bienvenido a la terminal central de operaciones de <strong>{{ config('app.name', 'nuestro Hotel') }}</strong>.<br>
        Administra reservas, habitaciones, huéspedes y auditorías de caja en tiempo real.
    </p>

    <div class="row g-4 justify-content-center fade-in" style="animation-delay: 0.2s;">

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-lg card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary p-3 rounded-3">
                            <i class="bi bi-calendar-check fs-3"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold text-dark">Libro de Reservaciones</h5>
                    <p class="card-text text-muted small">
                        Ingresa nuevas estancias, gestiona asignaciones de habitaciones, fechas de check-in / check-out y estados de confirmación.
                    </p>
                    <a href="{{ route('reservaciones.index') }}" class="btn btn-primary btn-sm w-100 py-2 mt-2 fw-semibold">
                        Abrir Reservas <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-lg card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success p-3 rounded-3">
                            <i class="bi bi-door-closed fs-3"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold text-dark">Control de Habitaciones</h5>
                    <p class="card-text text-muted small">
                        Monitorea el inventario físico, pisos, capacidades y actualiza la disponibilidad inmediata (Disponible / Ocupado).
                    </p>
                    <a href="{{ route('habitaciones.index') }}" class="btn btn-success btn-sm w-100 py-2 mt-2 fw-semibold">
                        Ver Habitaciones <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-lg card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-secondary bg-opacity-10 text-dark p-3 rounded-3">
                            <i class="bi bi-people-fill fs-3"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold text-dark">Padrón de Huéspedes</h5>
                    <p class="card-text text-muted small">
                        Accede al historial y base de datos de clientes, documentos de identidad, teléfonos y correos electrónicos de contacto.
                    </p>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-sm w-100 py-2 mt-2 fw-semibold text-white">
                        Expediente de Clientes <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="text-center text-white py-4 opacity-50 fade-in" style="animation-delay: 0.4s;">
    <small>
        &copy; {{ date('Y') }} {{ config('app.name', 'Hotel Engine') }} · Terminal Administrativa Privada · v1.0
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
