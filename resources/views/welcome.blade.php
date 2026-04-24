<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* 🎨 Fondo original con animación */
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            background-size: 400% 400%;
            animation: gradientMove 10s ease infinite;
            min-height: 100vh;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animación de entrada */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.15) !important;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-3 fade-in">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">
            <i class="bi bi-box-seam me-2"></i>{{ config('app.name', 'Laravel') }}
        </a>

        @if (Route::has('login'))
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-light">
                        <i class="bi bi-speedometer2 me-1"></i> Panel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-light">
                            <i class="bi bi-person-plus me-1"></i> Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<!-- Hero Section -->
<div class="container py-5 text-center text-white fade-in">
    <div class="d-flex justify-content-center mb-4">
        <div class="logo-circle shadow-lg">
            <i class="bi bi-lightning-charge-fill text-white fs-2"></i>
        </div>
    </div>

    <h1 class="display-4 fw-bold mb-3">Comencemos</h1>

    <p class="lead mb-5 opacity-75">
        Laravel tiene un ecosistema increíblemente completo.<br>
        Te sugerimos comenzar con lo siguiente.
    </p>

    <!-- Cards -->
    <div class="row g-4 justify-content-center fade-in">

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                            <i class="bi bi-book fs-4"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-semibold">Documentación</h5>
                    <p class="card-text text-muted">
                        Laravel tiene una documentación excelente que cubre todos los aspectos del framework.
                    </p>
                    <a href="https://laravel.com/docs" target="_blank" class="btn btn-primary btn-sm">
                        Leer documentación <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded-3">
                            <i class="bi bi-play-circle fs-4"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-semibold">Tutoriales</h5>
                    <p class="card-text text-muted">
                        Mira miles de tutoriales en video sobre Laravel, PHP y JavaScript.
                    </p>
                    <a href="https://laracasts.com" target="_blank" class="btn btn-danger btn-sm">
                        Ver tutoriales <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow card-hover">
                <div class="card-body p-4 text-start">
                    <div class="mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
                            <i class="bi bi-cloud-upload fs-4"></i>
                        </span>
                    </div>
                    <h5 class="card-title fw-semibold">Desplegar ahora</h5>
                    <p class="card-text text-muted">
                        Despliega tu aplicación en la nube con Laravel Cloud o Forge.
                    </p>
                    <a href="https://cloud.laravel.com" target="_blank" class="btn btn-success btn-sm">
                        Desplegar <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-center text-white py-4 opacity-75 fade-in">
    <small>
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} · PHP v{{ PHP_VERSION }}
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
