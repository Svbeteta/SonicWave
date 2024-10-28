<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Carrito;
use App\Models\DireccionUsuario;
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

    public function pago()
    {
        $carrito = Carrito::where('id_usuario', Auth::id())
                        ->where('estado', 'open')
                        ->with('detalles.producto')
                        ->first();

        if (!$carrito) {
            return redirect()->route('home')->with('error', 'No tienes un carrito activo.');
        }

        $total = $carrito->detalles->sum(fn($item) => $item->producto->precio * $item->cantidad);

        $direcciones = DireccionUsuario::where('id_usuario', Auth::id())
                                    ->with('geolocalizacion')
                                    ->get();

        $direccion = $direcciones->first(); 

        return view('pago', compact('carrito', 'total', 'direccion', 'direcciones'));
    }


    public function checkout(Request $request)
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();

        if (!$carrito || $carrito->detalles->isEmpty()) {
            return redirect()->route('pago')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total de la compra
        $total = $carrito->detalles->sum(fn($item) => $item->producto->precio * $item->cantidad);

        // Marcar el carrito como cerrado y actualizar el total
        $carrito->update(['estado' => 'closed', 'total' => $total]);

        return redirect()->route('home')->with('success', '¡Compra completada!');
    }

    public function getCartCount()
    {
        $carrito = Carrito::where('id_usuario', Auth::id())->where('estado', 'open')->first();
        return $carrito ? $carrito->detalles->sum('cantidad') : 0;
    }
}
