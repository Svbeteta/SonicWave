<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('oneview', compact('categorias'));
    }

    public function index2()
    {
        $categorias = Categoria::all();
        return view('products', compact('categorias'));
    }

    public function productosPorCategoria($slug)
{
    $categoria = Categoria::where('slug', $slug)->firstOrFail();

    $productos = Producto::where('id_categoria', $categoria->id_categoria)->get();

    return view('products', [
        'categoria' => $categoria,
        'productos' => $productos
    ]);
}
}
