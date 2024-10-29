@extends('layouts.shop')

<style>
    body {
        font-family: 'Raleway', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/images/chill.jpg') no-repeat center center;
        background-size: cover; 
        background-attachment: fixed; 
        background-position: center; 
        min-height: 100vh;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .close-modal-button {
        font-family: 'Raleway', sans-serif;
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        font-size: 1em;
        color: #000000;
        background-color: transparent;
        border: 1px solid #000000;
        border-radius: 25px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }
    .close-modal-button:hover {
        background-color: #f0f0f0;
    }
    .payment-option {
        display: block;
        margin: 10px 0;
    }
</style>

@section('content')
<div class="checkout-container">
    <div class="checkout-address-section">
        <h2>Dirección de Envío</h2>

        @if($direcciones->isNotEmpty())
            <label for="direccionSeleccionada">Selecciona una dirección:</label>
            <select id="direccionSeleccionada" name="direccionSeleccionada" class="form-select">
                @foreach($direcciones as $d)
                    <option value="{{ $d->id_direccion_usuario }}" {{ $d->id_direccion_usuario == $direccion->id_direccion_usuario ? 'selected' : '' }}>
                        {{ $d->geolocalizacion->direccion }}
                    </option>
                @endforeach
            </select>
            <form action="{{ route('direccion.eliminar') }}" method="POST" id="eliminarDireccionForm" style="display: inline;">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_direccion_usuario" id="idDireccionUsuario" value="{{ $direccion->id_direccion_usuario }}">
                <button type="submit" class="btn btn-danger">Eliminar dirección</button>
            </form>
            
            <a href="#" id="addAddressLink" class="checkout-add-address-link" onclick="openModal()">+ Agregar una dirección</a>
        @else
            <p>No tienes direcciones guardadas</p>
            <a href="#" id="addAddressLink" class="checkout-add-address-link" onclick="openModal()">+ Agregar una dirección</a>
        @endif
    </div>

    <div class="checkout-cart-summary">
        <h3>Resumen de la Compra</h3>
        <ul class="checkout-cart-items">
            @foreach ($carrito->detalles as $detalle)
                <li class="checkout-cart-item">
                    <div class="checkout-product-image-container">
                        <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}" class="checkout-product-image">
                        <span class="checkout-product-counter">{{ $detalle->cantidad }}</span>
                    </div>
                    <div class="checkout-item-info">
                        <span class="checkout-product-name">{{ $detalle->producto->nombre }}</span>
                        <span class="checkout-product-price">Q{{ number_format($detalle->producto->precio, 2) }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="checkout-price-summary">
            <p class="checkout-total-price">Total: <span>Q{{ number_format($total, 2) }}</span></p>
        </div>

        <form action="{{ route('pago.confirmar') }}" method="POST" id="checkoutForm">
            @csrf
            <button type="button" class="checkout-button" id="pagoButton" {{ !$direcciones->isNotEmpty() ? 'disabled' : '' }} onclick="openPaymentModal()">Continuar a método de pago</button>
        </form>
    </div>
</div>

<div id="addressModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h5 class="modal-title">Confirma la ubicación</h5>
        <div id="map" style="height: 300px; width: 100%; margin-top: 10px;"></div>
        
        <form id="locationForm" action="{{ route('guardarDireccion') }}" method="POST">
            @csrf
            <label for="direccion">Nombre de la Dirección:</label>
            <input type="text" id="direccion" name="direccion" placeholder="Ingresa el nombre de la dirección">
            <input type="hidden" id="latitud" name="latitud">
            <input type="hidden" id="longitud" name="longitud">
            <button type="submit" class="close-modal-button">Confirmar ubicación</button>
            <button onclick="closeModal()" class="close-modal-button">Cancelar</button>
        </form>
    </div>
</div>

<div id="paymentModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h5 class="modal-title">Seleccione el método de pago</h5>
        
        <div class="payment-options">
            <label class="payment-option">
                <input type="radio" name="paymentMethod" value="transferencia"> Transferencia bancaria
            </label>
            <label class="payment-option">
                <input type="radio" name="paymentMethod" value="tarjeta"> Tarjeta de crédito o débito
            </label>
            <label class="payment-option">
                <input type="radio" name="paymentMethod" value="efectivo"> Efectivo contra entrega
            </label>
        </div>
        
        <button onclick="completeCheckout()" class="close-modal-button">Confirmar método de pago</button>
        <button onclick="closeModal()" class="close-modal-button">Cancelar</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addressModal').style.display = 'flex';
    }
    function closeModal() {
        document.getElementById('addressModal').style.display = 'none';
    }

    function openPaymentModal() {
        document.getElementById('paymentModal').style.display = 'flex';
    }
    function closePaymentModal() {
        document.getElementById('paymentModal').style.display = 'none';
    }

    function completeCheckout() {
        closePaymentModal();
        document.getElementById('checkoutForm').submit();
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMznw6Z7nd2ODWJv8WnYuE_MiAujSmLUc&callback=initMap" async defer></script>
<script>
    let map, marker;
    let lat = 14.6349, lng = -90.5069;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: lat, lng: lng },
            zoom: 15,
        });
        marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            draggable: true,
        });
        marker.addListener('dragend', function() {
            lat = marker.getPosition().lat();
            lng = marker.getPosition().lng();
            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;
        });
    }
</script>
@endsection
