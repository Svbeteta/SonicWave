@extends('layouts.shop')

@section('content')
<div class="checkout-container">
    <div class="checkout-address-section">
        <h2>Dirección de Envío</h2>
        @if($direccion && $direccion->geolocalizacion)
            <p>Dirección guardada: {{ $direccion->geolocalizacion->direccion }}</p>
        @else
            <p>No tienes direcciones guardadas</p>
            <a href="#" id="addAddressLink" class="checkout-add-address-link" data-bs-toggle="modal" data-bs-target="#addressModal">+ Agregar una dirección</a>
        @endif
    </div>

    <!-- Modal para el Mapa -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Confirma la ubicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Mueve el marcador para confirmar la ubicación:</p>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmLocationButton" class="btn btn-primary" data-bs-dismiss="modal">Confirmar ubicación</button>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-cart-summary">
        <h3>Resumen de la Compra</h3>
        @if ($carrito && $carrito->detalles->isNotEmpty())
            <ul class="checkout-cart-items">
                @foreach ($carrito->detalles as $detalle)
                    <li class="checkout-cart-item">
                        <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}" class="checkout-product-image">
                        <div class="checkout-item-info">
                            <span class="checkout-product-name">{{ $detalle->producto->nombre }}</span>
                            <span class="checkout-product-price">Q{{ number_format($detalle->producto->precio, 2) }}</span>
                            <span class="checkout-product-quantity">{{ $detalle->cantidad }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="checkout-price-summary">
                <p class="checkout-total-price">Total: <span>Q{{ number_format($total, 2) }}</span></p>
            </div>
        @else
            <p>Tu carrito está vacío.</p>
        @endif
    </div>

    <form action="{{ route('pago.confirmar') }}" method="POST">
        @csrf
        <button type="submit" class="checkout-button" {{ !$direccion ? 'disabled' : '' }}>Confirmar Compra</button>
    </form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script>
    let map, marker;
    let lat = 14.6349, lng = -90.5069; // Coordenadas iniciales de Guatemala

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat, lng },
            zoom: 14,
        });

        marker = new google.maps.Marker({
            position: { lat, lng },
            map,
            draggable: true,
        });

        // Actualiza latitud y longitud al mover el marcador
        marker.addListener('dragend', function() {
            const position = marker.getPosition();
            lat = position.lat();
            lng = position.lng();
        });
    }

    // Manejo del botón "Confirmar ubicación"
    document.getElementById('confirmLocationButton').addEventListener('click', function () {
        fetch('/guardar-direccion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ latitud: lat, longitud: lng })
        })
        .then(response => response.json())
        .then(data => {
            alert('Dirección guardada con éxito');
            location.reload(); // Recargar la página para mostrar la dirección guardada
        })
        .catch(error => console.error('Error al guardar la dirección:', error));
    });
</script>
@endsection
