@extends('layouts.shop')

@section('content')
<div class="categoria-fondo" style="position: relative; height: 50vh; background-size: cover; background-position: center;">
    <div class="blur-overlay" style="background-image: url('{{ asset($categoria->imagen_fondo) }}'); filter: blur(5px); position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; z-index: -1;"></div>
    <h1 style="position: relative; z-index: 1;">{{ $categoria->nombre }}</h1>
</div>

<div class="container" style="padding: 20px;">
    <div class="product-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
        @foreach($productos as $producto)
            <div class="product-item" style="background-color: #fff; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" style="width: 100%; height: auto; max-height: 200px; object-fit: cover;">
                <h3>{{ $producto->nombre }}</h3>
                <p>{{ $producto->descripcion }}</p>
                <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection
