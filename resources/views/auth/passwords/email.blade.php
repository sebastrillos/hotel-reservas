@extends('layouts.app_authentication')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header text-center bg-white py-4">
                <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="Grand Hotel Logo" style="max-height: 60px;">
                <h4 class="mt-2 font-weight-bold text-muted">Recuperar Acceso</h4>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <p class="login-box-msg text-secondary small">Ingresa tu correo para enviarte un enlace de restauración</p>

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="input-group mb-4">
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>
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

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold shadow-sm">
                                <i class="fas fa-paper-plane mr-2"></i>{{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
