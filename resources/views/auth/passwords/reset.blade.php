@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<?php $title = "Resetejar contrasenya" ?>
@extends('layouts.base')

@push('styles')
<!-- VENTANA DE LOGIN -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/login/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/login/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')
<div class="limiter" style="background-color:#013660;">
    <div class="container-login100">
    <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="background-color: antiquewhite;">
        <form method="POST" action="{{ route('password.update') }}" class="login100-form validate-form flex-sb flex-w">
            @csrf

            <span class="login100-form-title p-b-53">
                Recuperar contrasenya
            </span>

            <div class="w-100 p-t-13 p-b-9">
                <label for="email" class="w-100 txt1">Email</label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span class="focus-input100"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="w-100 p-t-13 p-b-9">
                <label for="password" class="w-100 txt1">Contrasenya</label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="focus-input100"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="w-100 p-t-13 p-b-9">
                <label for="password-confirm" class="w-100 txt1">Contrasenya</label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn m-t-17">
                <button id="entrar" class="login100-form-btn botonForm">
                    Enviar
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
