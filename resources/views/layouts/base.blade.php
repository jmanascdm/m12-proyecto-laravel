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

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a4df976903.js" crossorigin="anonymous"></script>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/miCss.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-none d-lg-block" style="background-color:#f3ce54">
        <div class="container d-flex">
            <!-- Left side -->
            <div class="contact-info mr-auto">
                <i class="fas fa-reply" style="color:#00365f"></i><a href="https://www.inscamidemar.cat/">Tornar a INS
                    Camí de Mar</a>
            </div>
            <!-- Right side -->
            @guest
            <div>
                <i class="fas fa-user-alt iniciarSesion"></i><a href="https://www.inscamidemar.cat/"
                    class="iniciarSesion" style=";">Iniciar Sessió</a>
            </div>
            @else
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Tancar
                        sessió</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center" style="background-color: #f6dd7e">
        <div class="container d-flex align-items-center">

            <div class="logo mr-auto">
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="/"><img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="img-fluid"
                        style="height: 200p"></a>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li><a href="#" style="color:grey">Inici</a></li>
                    <li><a href="#">ESO</a></li>
                    <li><a href="#">Batxillerat</a></li>
                    <li><a href="#">Cicles formatius</a></li>
                    <li><a href="#">Professorat</a></li>
                </ul>
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
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/jquery-sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
