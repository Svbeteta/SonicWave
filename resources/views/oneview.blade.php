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
            <img src="{{ asset('images/grocery-store.png') }}" alt="Carrito" class="cart-icon">
            <span class="cart-count">{{ $cartCount ?? 0 }}</span> 
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
                <a href="{{ route('categoria.productos', ['slug' => $categoria->slug]) }}">
                    <div class="overlay"></div>
                    <h3>{{ $categoria->nombre }}</h3>
                </a>
            </div>
        @endforeach
    </div>
</section>



<section id="contact">
    <div class="contact-container">
            <div class="contact-form">
            <h2>¡Queremos Escucharte!</h2>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Tu Nombre" required>
                
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Tu Correo" required>
                
                <label for="message">Mensaje:</label>
                <textarea name="message" id="message" placeholder="Escribe tu mensaje aquí" required></textarea>
                
                <button type="submit">Enviar</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Ubicación de Nuestras Sucursales</h3>
            
            <div id="map" style="height: 400px; border-radius: 8px;">
            </div>
            
            <div class="office-info">
    @foreach ($sucursales as $sucursal)
        <h4>{{ $sucursal->nombre }}</h4>
        <p>{{ $sucursal->geolocalizacion->direccion }}</p>
    @endforeach
</div>


    </div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMznw6Z7nd2ODWJv8WnYuE_MiAujSmLUc&callback=initMap" async defer></script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 14.5943, lng: -90.5178},
            zoom: 13
        });

        fetch('/api/sucursales')
            .then(response => response.json())
            .then(data => {
                console.log("Datos de sucursales recibidos:", data);
                
                data.forEach(function(sucursal) {
                    if (sucursal.geolocalizacion) {
                        const lat = parseFloat(sucursal.geolocalizacion.latitud);
                        const lng = parseFloat(sucursal.geolocalizacion.longitud);

                        var marker = new google.maps.Marker({
                            position: { lat: lat, lng: lng },
                            map: map,
                            title: sucursal.nombre,
                        });

                        var infoWindow = new google.maps.InfoWindow({
                            content: `<h4>${sucursal.nombre}</h4><p>${sucursal.geolocalizacion.direccion}</p>`,
                        });

                        marker.addListener("click", function() {
                            infoWindow.open(map, marker);
                        });
                    }
                });
            })
            .catch(error => console.error('Error cargando sucursales:', error));
    }
</script>


    <footer style="text-align: center;">
    <p>&copy; 2024 - SonicWave || Crafted with 💻 and ☕ by Samuel Beteta</p>
    </footer>

</body>
</html>
