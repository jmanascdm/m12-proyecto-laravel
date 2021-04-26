@extends('layouts.base')

@section('content')

<div class="limiter" style="background-color:#013660;">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="background-color: antiquewhite;">
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form flex-sb flex-w">
                @csrf

                <span class="login100-form-title p-b-53">
                    LOGIN
                </span>


                <label for="email" class="txt1">
                    Email
                </label>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100 @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                    </span>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Restaura la contrasenya
                    </a>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100 @error('password') is-invalid @enderror" id="password" name="password" type="password" required autocomplete="current-password">
                    <span class="focus-input100"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <button type="submit" class="login100-form-btn botonForm">
                        Entra
                    </button>
                </div>

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

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

@endsection
