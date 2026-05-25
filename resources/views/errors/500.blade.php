@extends('layouts.app')

@push('css')
    <style>
        .error-wrapper-custom {
            background: #f4f6f9;
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card-custom {
            background: #ffffff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: center;
            max-width: 650px;
            width: 100%;
            border-top: 6px solid #6610f2;
        }

        .minecraft-hotel {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        .hotel-icon {
            font-size: 100px;
            color: #343a40;
            position: relative;
        }

        .sign-500 {
            position: absolute;
            top: 10px;
            right: -30px;
            background: #6610f2;
            color: white;
            padding: 5px 15px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 22px;
            border: 3px solid #000;
            transform: rotate(10deg);
            box-shadow: 4px 4px 0px #2a0066;
            animation: swing 2s infinite ease-in-out;
        }

        @keyframes swing {
            0%, 100% { transform: rotate(10deg); }
            50% { transform: rotate(15deg); }
        }

        .error-title-text {
            font-size: 38px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .error-desc-text {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .btn-action-home {
            background-color: #6610f2;
            color: #ffffff !important;
            font-weight: 600;
            padding: 15px 45px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none !important;
            display: inline-block;
            border: none;
            box-shadow: 0 4px 15px rgba(102, 16, 242, 0.2);
        }

        .btn-action-home:hover {
            background-color: #560bd0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 16, 242, 0.3);
        }

        .code-label {
            display: block;
            margin-top: 30px;
            font-weight: 700;
            color: #dee2e6;
            letter-spacing: 8px;
            text-transform: uppercase;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper error-wrapper-custom">
        <div class="error-card-custom">

            <div class="minecraft-hotel">
                <i class="fas fa-tools hotel-icon"></i>
                <div class="sign-500">500</div>
            </div>

            <h1 class="error-title-text">Algo salió mal en el servidor</h1>

            <p class="error-desc-text">
                Ocurrió un error interno inesperado. Nuestro equipo ya fue notificado. Por favor, intenta de nuevo en unos momentos.
            </p>

            <a href="{{ url('/home') }}" class="btn-action-home">
                <i class="fas fa-arrow-left mr-2"></i> Regresar al panel principal
            </a>

            <span class="code-label">Error 500</span>
        </div>
    </div>
@endsection
