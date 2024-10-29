<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index()
{
    $orders = Pedido::with(['carrito.detalles.producto'])
                    ->whereHas('carrito')
                    ->orderBy('fecha_transaccion', 'desc')
                    ->get();

    return view('pedidos', compact('orders'));
}


}
