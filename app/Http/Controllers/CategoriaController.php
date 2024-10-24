<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mantener las funciones existentes
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
    // Obtener la categoría según el slug de la URL
    $categoria = Categoria::where('slug', $slug)->firstOrFail();

    // Obtener los productos de esa categoría
    $productos = Producto::where('id_categoria', $categoria->id_categoria)->get();

    // Pasar los productos y la categoría a la vista
    return view('products', [
        'categoria' => $categoria,
        'productos' => $productos
    ]);
}
}
