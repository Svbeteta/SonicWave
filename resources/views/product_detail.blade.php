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

<div class="product-details-container">
    <div class="product-image">
        <img src="{{ asset($producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}">
    </div>

    <div class="product-info">
        <h1>{{ $producto->nombre }}</h1>
        <p class="product-price">Precio: Q {{ number_format($producto->precio, 2) }}</p>
        <p>{{ $producto->descripcion }}</p>

        <form action="{{ route('carrito.add', $producto) }}" method="POST" style="margin-top: 20px;">
            @csrf
            <label for="quantity">Cantidad:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max ="10" style="width: 60px; padding: 5px; margin-left: 5px; margin-bottom: 15px;">
            <button type="submit" class="add-to-cart-btn">
                <img src="{{ asset('images/grocery-store.png') }}" alt="Carrito" style="width: 20px; height: 20px;">
                Añadir al carrito
            </button>
        </form>

        <a href="{{ route('categoria.productos', ['slug' => $producto->categoria->slug]) }}" class="back-to-category">
            ← Volver a {{ $producto->categoria->nombre }}
        </a>
    </div>
</div>

@endsection
