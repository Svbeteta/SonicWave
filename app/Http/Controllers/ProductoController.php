<?php

namespace App\Http\Controllers;

use App\Models\Producto; 

class ProductoController extends Controller
{
    public function show($slug)
    {
        $producto = Producto::where('slug', $slug)->firstOrFail();

        return view('product_detail', compact('producto'));
    }
}
