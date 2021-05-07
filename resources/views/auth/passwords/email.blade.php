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
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form flex-sb flex-w">
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
