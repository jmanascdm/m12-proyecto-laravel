<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>INS Camí de Mar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <!-- JQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a4df976903.js" crossorigin="anonymous"></script>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/miCss.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center" style="background-color: #f6dd7e">
        <div class="container d-flex align-items-center">

            <div class="logo mr-auto">
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="/"><img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="img-fluid"
                        style="height: 200px"></a>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                @guest
                    <a href="{{ route('login') }}" class="iniciarSesion"><i class="fas fa-user-alt iniciarSesion"></i>Iniciar Sessió</a>
                @else
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header">Zona admin</h6>
                        <a class="dropdown-item" href="{{ route('admin.accounts') }}">Comptes</a>
                        <a class="dropdown-item" href="{{ route('admin.payments') }}">Pagaments</a>
                        <a class="dropdown-item" href="{{ route('admin.categories') }}">Categories</a>
                        <a class="dropdown-item" href="{{ route('admin.users') }}">Usuaris</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Tancar
                            sessió</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                @endguest
            </nav>

        </div>
    </header>
    <!-- End Header -->

    <!-- End #main -->
    <main>
        @yield('content')
    </main>
    <!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer" style="background-color:#f3ce54 ; color:#00365f">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>INS Camí de Mar</span></strong>. Calafell
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('vendor/counterup/counterup.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
