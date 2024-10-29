@extends('layouts.shop')

@section('content')
<div class="orders-container">
    <h2>Mis Pedidos</h2>

    @forelse ($orders as $order)
        <div class="order-card">
            <h3>Pedido #{{ $order->id_pedido }} - {{ $order->fecha_transaccion?->format('d M Y') ?? 'Sin fecha' }}</h3>
            
            <p><strong>Total:</strong> Q{{ number_format($order->total, 2) }}</p>
            
            <p><strong>ID de Dirección de Envío:</strong> 
                {{ $order->id_direccion_usuario ?? 'Dirección no especificada' }}
            </p>
            
            <div class="order-items">
                <h4>Detalles del Pedido:</h4>
                <ul>
                    @foreach ($order->carrito?->detalles ?? [] as $item)
                        <li class="order-item">
                            <img src="{{ asset($item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="product-image">
                            <span class="product-name">{{ $item->producto->nombre }}</span>
                            <span class="product-quantity">Cantidad: {{ $item->cantidad }}</span>
                            <span class="product-price">Precio: Q{{ number_format($item->producto->precio, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p>No tienes pedidos realizados.</p>
    @endforelse
</div>
@endsection
