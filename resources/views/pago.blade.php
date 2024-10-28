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
</style>

@section('content')
<div class="checkout-container">
    <div class="checkout-address-section">
        <h2>Dirección de Envío</h2>
        <p>No tienes direcciones guardadas</p>
        <a href="#" class="checkout-add-address-link">+ Agregar una dirección</a>
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

        <form action="{{ route('pago.confirmar') }}" method="POST">
            @csrf
            <button type="submit" class="checkout-button">Confirmar Compra</button>
        </form>
    </div>
</div>
@endsection