@extends('layouts.app_authentication')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header text-center bg-white py-4">
                <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="Grand Hotel Logo" style="max-height: 60px;">
                <h4 class="mt-2 font-weight-bold text-muted">Nueva Contraseña</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('password.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nueva Contraseña" required autocomplete="current-password">
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Nueva Contraseña" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-secondary"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold shadow-sm">
                                <i class="fas fa-sync-alt mr-1"></i> {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
