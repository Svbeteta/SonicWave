@extends('layouts.shop')

@section('content')

<div class="categoria-fondo">
    <div class="blur-overlay" style="background-image: url('{{ asset($categoria->imagen_fondo) }}');"></div>
</div>

<div class="container">
    <div class="category-product-grid">
        @foreach($productos as $producto)
            <div class="category-product-item">
                <img src="{{ asset($producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" loading="lazy">
                <h3>{{ $producto->nombre }}</h3>
                <p><strong>Precio:</strong> Q.{{ number_format($producto->precio, 2) }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection