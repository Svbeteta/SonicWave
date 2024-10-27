<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Carrito;
use App\Models\DetallesCarrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
        public function show()
    {
        $carrito = Carrito::with('detalles.producto')
                    ->where('id_usuario', Auth::id())
                    ->where('estado', 'open')
                    ->first();

        $total = $carrito ? $carrito->detalles->sum(fn($item) => $item->producto->precio * $item->cantidad) : 0;
        $cartCount = $carrito ? $carrito->detalles->sum('cantidad') : 0;

        return view('carrito', compact('carrito', 'total', 'cartCount'));
    }



    // Add a product to the carrito
    public function add(Request $request, Producto $producto)
    {   
        $carrito = Carrito::firstOrCreate(
            ['id_usuario' => Auth::id(), 'estado' => 'open'],
            ['total' => 0]
        );

        $detalle = $carrito->detalles()->where('id_producto', $producto->id_producto)->first();

        if ($detalle) {
            $detalle->increment('cantidad', $request->input('quantity', 1));
        } else {
            $carrito->detalles()->create([
                'id_producto' => $producto->id_producto,
                'cantidad' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('carrito')->with('success', 'Producto añadido al carrito.');
    }

    // Update product quantity in the carrito
    public function update(Request $request, Producto $producto)
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();
        
        if ($carrito) {
            $detalle = $carrito->detalles()->where('id_producto', $producto->id_producto)->first();
            if ($detalle) {
                $detalle->update(['cantidad' => $request->input('quantity', 1)]);
            }
        }

        return redirect()->route('carrito')->with('success', 'Carrito actualizado.');
    }

    // Remove a product from the carrito
    public function remove(Producto $producto)
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();

        if ($carrito) {
            $detalle = $carrito->detalles()->where('id_producto', $producto->id_producto)->first();
            if ($detalle) {
                $detalle->delete();
            }
        }

        return redirect()->route('carrito')->with('success', 'Producto eliminado del carrito.');
    }

    // Checkout: finalize the carrito
    public function checkout()
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();

        if (!$carrito || $carrito->detalles->isEmpty()) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        // Finalize the carrito and update the total
        $total = $carrito->detalles->sum(fn($item) => $item->producto->precio * $item->cantidad);
        $carrito->update(['estado' => 'closed', 'total' => $total]);

        // Optionally, create a new `Pedido` record here

        return redirect()->route('carrito')->with('success', '¡Compra completada!');
    }

    // Helper function to get cart count
    public function getCartCount()
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();
        return $carrito ? $carrito->detalles->sum('cantidad') : 0;
    }
}
