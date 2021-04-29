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

                <div class="g-recaptcha" data-callback="captchaSuccess" data-sitekey="6Lf-Wb0aAAAAAIvniwskBL4euyHPxgMnA32beSfX"></div>                

                <div class="container-login100-form-btn m-t-17">
                    <button id="entrar" class="login100-form-btn botonForm">
                        Entra
                    </button>
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

@endpush