<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} — Verify Email</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 1.5rem 3rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 480px;
        }
        .verify-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        .logo-circle {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6, #6a3f96);
            border: none;
        }
        .btn-resend {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        .btn-resend:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        .back-link {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            color: white;
        }
        .icon-envelope {
            font-size: 2.5rem;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }
    </style>
</head>
<body>

<div class="w-100 px-3">

    <!-- Back to home -->
    <div class="text-center mb-3">
        <a href="{{ url('/') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i> Back to home
        </a>
    </div>

    <div class="verify-card card mx-auto">

        <!-- Header -->
        <div class="verify-header">
            <div class="logo-circle">
                <i class="bi bi-envelope-check-fill icon-envelope"></i>
            </div>
            <h4 class="fw-bold mb-1">{{ __('Verify Your Email') }}</h4>
            <p class="mb-0 opacity-75 small">One more step to get started</p>
        </div>

        <!-- Body -->
        <div class="card-body p-4 text-center">

            {{-- Success alert --}}
            @if (session('resent'))
                <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill text-success"></i>
                    <span>{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </div>
            @endif

            {{-- Info icon --}}
            <div class="mb-4 mt-2">
                <i class="bi bi-info-circle text-muted" style="font-size:1.1rem;"></i>
                <p class="text-muted mt-2 mb-0">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </p>
            </div>

            {{-- Divider --}}
            <hr class="my-3">

            {{-- Resend --}}
            <p class="text-muted small mb-3">
                {{ __('If you did not receive the email') }}, you can request a new one below.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-send me-2"></i>{{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

        </div>

        {{-- Footer --}}
        <div class="card-footer text-center bg-light py-3">
            <span class="text-muted small">Wrong account?</span>
            <form class="d-inline" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-resend ms-1 small">
                    {{ __('Log out') }}
                </button>
            </form>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
