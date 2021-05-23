<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }} | Pagaments INS Camí de Mar</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 

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
                <a  href="{{ route('home') }}" tabindex="1" title="Tornar a l'inici"><img src="{{ asset('img/logo.jpg') }}" alt="Web-logo" class="img-fluid"
                        style="height: 200px"></a>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                @guest
                    <a href="{{ route('login') }}" tabindex="2" class="iniciarSesion" title="Iniciar sessió"><i class="fas fa-user-alt iniciarSesion"></i>Iniciar Sessió</a>
                @else
                <div class="dropdown">
                    <button class="dropdown-toggle" tabindex="2" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header">Zona admin</h6>
                        <a class="dropdown-item" href="{{ route('admin.payments') }}" title="Visualitzar la taula de Pagaments">Pagaments</a>
                        <a class="dropdown-item" href="{{ route('admin.categories') }}" title="Visualitzar la taula de Categories">Categories</a>
                        <a class="dropdown-item" href="{{ route('admin.accounts') }}" title="Visualitzar la taula de Comptes">Comptes</a>
                        <a class="dropdown-item" href="{{ route('admin.users') }}" title="Visualitzar la taula d'Usuaris">Usuaris</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" title="Tancar sessió"
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
        <div id="noscript" class="offset-md-3 col-md-6">
            <noscript>El teu navegador no permet l'execució de fitxers JavaScript. Per continuar utilitzant la pàgina, per favor, revisi la seva configuració.</noscript>
        </div>
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

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-sticky/jquery.sticky.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Notificacions -->
    <script src="{{ asset('js/notifications/notifications.js') }}"></script>
    <script>
    const successNotf = window.createNotification({
        theme: 'success',
        showDuration: 5000
    });

    const errorNotf = window.createNotification({
        theme: 'error',
        showDuration: 5000
    });

    const infoNotf = window.createNotification({
        theme: 'info',
        showDuration: 5000
    });
    </script>
    @stack('scripts')
</body>

</html>
