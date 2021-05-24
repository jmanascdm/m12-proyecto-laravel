<?php $title = "Registra't" ?>
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
        <form method="POST" action="{{ route('register') }}"  class="login100-form validate-form flex-sb flex-w">
            @csrf

            <h1 class="login100-form-title p-b-53">
                REGISTRE
            </h1>

            <div class="w-100 p-t-13 p-b-9">
                <label for="name" class="w-100 txt1">
                    Nom d'usuari
                </label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input id="name" type="text" class="input100  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="usuari0" pattern="^[a-zA-Z0-9\_]{4,255}$" required autocomplete="name" autofocus>
                <span class="focus-input100"></span>
            </div>

            <div class="p-t-13 p-b-9">
                <label for="email" class="txt1">
                    Email
                </label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input class="input100 @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="correu@proba.com" pattern="^[a-zA-Z0-9]+\@[a-zA-Z]+(\.[a-zA-Z]{2,3}){1,2}$" required autocomplete="email" autofocus>
                <span class="focus-input100"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="p-t-13 p-b-9">
                <label for="password" class="txt1">
                    Contrassenya
                </label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100 @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="···········" required autocomplete="current-password">
                <span class="focus-input100"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="w-100 p-t-13 p-b-9">
                <label for="password-confirm" class="w-100 txt1">
                Confirmar contrassenya
                </label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100" id="password-confirm" type="password" name="password_confirmation" placeholder="···········" required required autocomplete="new-password">
                <span class="focus-input100"></span>
            </div>

            <div class="w-100 p-t-13 p-b-9">
                <label for="code" class="txt1">
                Codi de registre
                </label>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input id="code" type="text" class="input100" name="code" placeholder="AbCd0123" required>
                <span class="focus-input100"></span>
                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>           

            <div class="container-login100-form-btn m-t-17">
                <button class="login100-form-btn botonForm">
                    Registrar-se
                </button>
            </div>
            <div class="container-login100-form-btn m-t-17">
                <button class="login100-form-btn" style="background-color: white;color:black">
                <img src="{{ asset('img/icons/icon-google.png') }}" alt="Google-logo" style="padding-right: 10px;">
                Google
                </button>
            </div>
            <div class="w-full text-center p-t-55 hoverForm">
                <span class="txt2">
                Ja tens un compte?
                </span>

                <a href="{{ route('login') }}" class="txt2 bo1" title="Inicia sessió a la web">
                Accedir
                </a>
            </div>

        </form>
    </div>
    </div>
</div>

@endsection