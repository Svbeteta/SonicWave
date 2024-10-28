@extends('layouts.shop')

@section('content')

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

<div class="cart-container">
    <h1>Carrito</h1>

    @if($carrito && $carrito->detalles->isNotEmpty())
        <div class="cart-items-wrapper">
            <div class="cart-item-list">
                @foreach($carrito->detalles as $detalle)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}">
                        </div>
                        <div class="item-details">
                            <h3>{{ $detalle->producto->nombre }}</h3>
                            <p class="price">
                                Q {{ number_format($detalle->producto->precio * $detalle->cantidad, 2) }}
                            </p>
                            @if($detalle->cantidad > 1)
                                <span class="unit-price">Q {{ number_format($detalle->producto->precio, 2) }} c/u</span>
                            @endif
                        </div>
                        <div class="item-controls">
                            <form action="{{ route('carrito.update', $detalle->producto) }}" method="POST" class="quantity">
                                @csrf
                                <button type="submit" name="quantity" value="{{ $detalle->cantidad - 1 }}" class="qty-btn" {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>-</button>
                                <span class="qty">{{ $detalle->cantidad }}</span>
                                <button type="submit" name="quantity" value="{{ $detalle->cantidad + 1 }}" class="qty-btn">+</button>
                            </form>
                            <form action="{{ route('carrito.remove', $detalle->producto) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">🗑️</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>

        <div class="cart-summary-box">
            <p><strong>Total:</strong> Q {{ number_format($total, 2) }}</p>
            <form action="{{ route('pago') }}" method="GET">
                @csrf
                <button type="submit" class="checkout-btn">Iniciar compra</button>
            </form>
        </div>
    @else
        <p>Tu carrito está vacío.</p>
    @endif

    <div class="button-container">
    <a href="/#products" class="continue-shopping-btn">Buscar más productos</a>
    </div>


</div>
@endsection

