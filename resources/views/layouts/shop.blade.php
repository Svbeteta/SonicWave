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

    <!-- Inline Flexbox CSS to Position Footer -->
    <style>
        /* Main container as a flex column */
        body, .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Content area to grow and push footer down */
        .content {
            flex: 1;
            padding: 20px;
        }

        /* Footer positioning */
        .footer {
            margin-top: auto; /* Pushes footer to the bottom when content is insufficient */
        }
    </style>
</head>
<body>

<div class="main-container">
    
    <!-- Navigation -->
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
                <span class="cart-count">{{ $cartCount ?? 0 }}</span> 
            </a>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 - SonicWave || Crafted with 💻 and ☕ by Samuel Beteta</p>
    </footer>
</div>

</body>
</html>
