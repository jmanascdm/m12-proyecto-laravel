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

            <input type="hidden" name="token" value="{{ $token }}">

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
                <label for="password" class="w-100 txt1">Nova contrasenya</label>
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
                <label for="password-confirm" class="w-100 txt1">Confirmar contrasenya</label>
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
