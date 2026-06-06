@extends('layouts.app')

@section('title', 'Confirmar Contraseña')

@section('content')
    <div class="content-wrapper">
        <section class="content pt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary shadow-lg">
                            <div class="card-header bg-white">
                                <h3 class="card-title text-muted font-weight-bold">
                                    <i class="fas fa-shield-alt text-primary mr-2"></i>{{ __('Confirm Password') }}
                                </h3>
                            </div>

                            <div class="card-body">
                                <p class="text-secondary small mb-4">
                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Please confirm your password before continuing.') }}
                                </p>

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <label for="password" class="text-secondary font-weight-bold">{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Introduce tu clave actual">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="submit" class="btn btn-primary btn-flat font-weight-bold shadow-sm">
                                            <i class="fas fa-check-double mr-1"></i> {{ __('Confirm Password') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link text-sm text-secondary" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
