@extends('layouts.app_authentication')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header text-center bg-white py-4">
                <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="Grand Hotel Logo" style="max-height: 60px;">
                <h4 class="mt-2 font-weight-bold text-muted">{{ __('Log In') }}</h4>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-secondary small">Introduce tus credenciales para acceder</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="Correo electrónico">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-secondary"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-secondary"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold shadow-sm">
                                <i class="fas fa-sign-in-alt mr-1"></i> {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted small">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
