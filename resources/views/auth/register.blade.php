@extends('layouts.app_authentication')

@section('title', 'Registro')

@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header text-center bg-white py-4">
                <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="Grand Hotel Logo" style="max-height: 60px;">
                <h4 class="mt-2 font-weight-bold text-muted">{{ __('Register') }}</h4>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-secondary small">Crea una nueva cuenta de usuario para el sistema</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                               placeholder="Nombre completo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user text-secondary"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">
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

                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password" placeholder="Contraseña">
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

                    <div class="input-group mb-4">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password" placeholder="Confirmar contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-secondary"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold shadow-sm">
                                <i class="fas fa-user-plus mr-1"></i> {{ __('Register') }}
                            </button>
                        </div>
                        <div class="col-7 text-right">
                            <a href="{{ route('login') }}" class="text-success small font-weight-bold">
                                {{ __('I already have an account') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
