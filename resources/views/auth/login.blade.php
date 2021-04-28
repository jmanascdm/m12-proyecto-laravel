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
                    <input class="input100 @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="correu@proba.com" required autocomplete="email" autofocus>
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

                <div class="p-t-13 p-b-9">
                    <label for="captcha-inp" class="txt1">
                        Captcha
                    </label>
                </div>
                <div id="captcha" class="wrap-input100 text-center">
                    <div class="controls">
                        <div class="row">
                            <input class="user-text input100" placeholder="Escriu aqui" id="captcha-inp" name="captcha" type="text" required/>
                        </div>
                        <div class="row">
                            <button class="refresh">Provar altre</button>
                        </div>
                        <div class="row">
                            <button class="validate login100-form-btn botonForm">
                                Entra
                            </button>
                        </div>
                    </div>
                </div>

                <div class="container-login100-form-btn m-t-17">
                </div>
            </form>

                <div class="container-login100-form-btn m-t-17">
                    <button class="login100-form-btn" style="background-color: white;color:black">
                        <img src="{{ asset('img/icons/icon-google.png') }}" alt="GOOGLE" style="padding-right: 10px;">
                        Google
                    </button>
                </div>
                <div class="w-full text-center p-t-55 hoverForm">
                    <span class="txt2">
                        Encara no tens compte?
                    </span>

                    <a href="{{ route('register') }}" class="txt2 bo1">
                        Crear compte
                    </a>
                </div>
                
        </div>
    </div>
</div>

@push('scripts')

<script>
    $('button').click(function(e) {
        e.preventDefault();
        return false;
    })
</script>
<script src="{{ asset('js/captcha/client_captcha.js') }}" defer></script>
<script src="{{ asset('js/notifications/notifications.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const errorNotf = window.createNotification({
        theme: 'error',
        showDuration: 3000
    });
    
    var captcha = new $.Captcha({
		onFailure: function() {
            errorNotf({
                title: 'Error!',
                message: 'Captcha incorrecte',
            });
        },
        
		onSuccess: function() {
            $('form').submit();
		}
	});

	captcha.generate();
})
</script>

@endpush

@endsection
