<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SonicWave</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="icon" href="images/wave-sound.png" type="image/png">
</head>
<body>

<nav>
    <h2>SonicWave</h2>
    <ul>
        <li><a href="#home">Inicio</a></li>
        <li><a href="#about">Sobre Nosotros</a></li>
        <li><a href="#products">Productos</a></li>
        <li><a href="#contact">Contacto</a></li>
    </ul>

    <div class="profile-section">
        @if (Auth::check())
            <a href="{{ route('dashboard') }}" class="login">{{ Auth::user()->name }}</a>
        @else
            <a href="/login" class="login">Iniciar Sesión</a>
        @endif
        <a href="/carrito" class="cart-link">
            <img src="/images/grocery-store.png" alt="Carrito" class="cart-icon">
            <span class="cart-count">0</span> 
        </a>
    </div>

</nav>


    <section id="home">
    <div class="content">
        <h1>SonicWave</h1>
        <p>instrumentos modernos y vintage para cada sonido</p>
        <a href="#products" class="view-products-btn">Ver Productos</a>
    </div>
    </section>

    <section id="about">
    <div class="about-container">
        <div class="about-text">
            <h2>Descubre SonicWave</h2>
            <h3>Tu aventura musical comienza aquí</h3>
            <p>
            En SonicWave, ofrecemos una amplia selección de instrumentos modernos y vintage para cada sonido. Ya seas un principiante o un profesional experimentado, te brindamos las herramientas y la inspiración para crear música que resuene. Descubre nuestra colección única y desbloquea todo tu potencial creativo.
            </p>
            <a href="#contact" class="cnt-btn">Contáctanos</a>
        </div>
    </div>
</section>


<section id="products">
    <div class="products-container">
        @foreach ($categorias as $categoria)
            <div class="product-item" style="background-image: url('{{ asset($categoria->imagen) }}');">
                <a href="{{ route('categoria.productos', ['categoriaId' => $categoria->id_categoria]) }}">
                    <div class="overlay"></div>
                    <h3>{{ $categoria->nombre }}</h3>
                </a>
            </div>
        @endforeach
    </div>
</section>



    <section id="contact">
        <h2>Contact Us</h2>
        <form action="/contact" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </section>

    <footer style="text-align: center;">
    <p>&copy; 2024 - SonicWave || Crafted with 💻 and ☕ by Samuel Beteta</p>
    </footer>

</body>
</html>
