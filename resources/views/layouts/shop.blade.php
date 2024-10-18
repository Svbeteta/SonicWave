<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SonicWave')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="icon" href="{{ asset('images/wave-sound.png') }}" type="image/png">
</head>
<body>

<nav>
    <h2>SonicWave</h2>
    <ul>
        <li><a href="/#home">Inicio</a></li>
        <li><a href="/#about">Sobre Nosotros</a></li>
        <li><a href="/#products">Productos</a></li>
        <li><a href="/#contact">Contacto</a></li>
    </ul>

    <div class="profile-section">
        @if (Auth::check())
            <a href="{{ route('dashboard') }}" class="login">{{ Auth::user()->name }}</a>
        @else
            <a href="/login" class="login">Iniciar Sesión</a>
        @endif
        <a href="/carrito" class="cart-link">
            <img src="{{ asset('images/grocery-store.png') }}" alt="Carrito" class="cart-icon">
            <span class="cart-count">0</span> 
        </a>
    </div>

</nav>

<div class="content">
    @yield('content')
</div>

<footer style="text-align: center;">
    <p>&copy; 2024 - SonicWave || Crafted with 💻 and ☕ by Samuel Beteta</p>
</footer>

</body>
</html>
