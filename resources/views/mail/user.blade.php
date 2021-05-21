<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <style>
        * {
            font-family: Poppins;
        }
        body {
            margin: 0;
        }
        main {
            background-color: #f6dd7e;
            display: grid;
            place-items: center;
            padding-bottom: 5em;
        }
        code {
            color: #013660;
            background-color: white;
            border: 1px solid lightgray;
            border-radius: .5em;
            margin: 1em;
            padding: .5em;
            font-size: 2em;
        }
        img {
            padding: 3em;
            width: 400px;
        }
        footer {
            text-align: center;
            padding: 2em;
        }
    </style>
</head>
<body>
    <main>
        <img src="{{ asset('img/logo.jpg') }}" alt="Web-logo">
        <p>Aquest és tu codi de registre:</p>
        <code><strong>{{ $code }}</strong></code>
        <p>Registra't <a href="http://m12proyecto.com/register" title="Registra't a la web" target="_blank">aquí</a>.</p>
    </main>
    <footer id="footer" style="background-color:#f3ce54 ; color:#00365f">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>INS Camí de Mar</span></strong>. Calafell
            </div>
        </div>
    </footer>
</body>
</html>