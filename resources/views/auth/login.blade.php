<?php $title = "Login" ?>
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
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form flex-sb flex-w">
                @csrf

                <span class="login100-form-title p-b-53">
                    LOGIN
                </span>

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

                <div class="d-flex p-t-13 p-b-9">
                    <label for="password" class="txt1">
                        Contrassenya
                    </label>
                    <a class="ml-4" href="{{ route('password.request') }}">
                        Restaura la contrasenya
                    </a>
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

                <div class="g-recaptcha mt-3 mr-auto ml-auto" data-callback="captchaSuccess" data-sitekey="{{ env('GOOGLE_CAPTCHA') }}"></div>

                <div class="container-login100-form-btn m-t-17">
                    <button id="entrar" class="login100-form-btn botonForm">
                        Entrar
                    </button>
                </div>
            </form>

            <div class="container-login100-form-btn m-t-17">
                <button id="googlelogin" class="login100-form-btn" style="background-color: white;color:black">
                    <img src="{{ asset('img/icons/icon-google.png') }}" alt="GOOGLE" style="padding-right: 10px;">
                    Google
                </button>
            </div>
            <div class="w-full text-center p-t-55 hoverForm">
                <span class="txt2">
                    Encara no tens compte?
                </span>

                <a href="{{ route('register') }}" class="txt2 bo1">
                    Crea un compte
                </a>
            </div>
                
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://www.google.com/recaptcha/api.js?hl=ca" async defer></script>
<script src="{{ asset('js/notifications/notifications.js') }}"></script>
<script>
    $('button').click(function(e) {
        e.preventDefault();
        return false;
    })

    var captcha = false;

    function captchaSuccess() {
        captcha = true;
    }

    $('#entrar').click(function() {
        const errNo = window.createNotification({
            theme: 'error',
            showDuration: 3000
        });

        if(captcha) {
            document.forms[0].submit();
        } else {
            errNo({
                title: 'Error!',
                message: 'Captcha invàlid',
            });
        }
    })
</script>
<script>
$('#googlelogin').click(function() {
    location.assign("{{ route('google.redirect') }}");
})
</script>

@endpush