<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SonicWave</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/inicio">Inicio</a></li>
                <li><a href="/categorias">Categorías</a></li>
                <li><a href="/as">Sucursales</a></li>
                <li><a href="/as">Mi Cuenta</a></li>
                <li><a href="/as">Mi Carrito</a></li>
                <li><a href="/as">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content') 
    </div>

    <footer>
        <p>&copy; 2024 - SonicWave</p>
    </footer>
</body>
</html>
