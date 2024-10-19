<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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

    public function productosPorCategoria($categoriaId)
    {
        // Asegurarse de que busca por 'id_categoria' en lugar de 'id'
        $categoria = Categoria::where('id_categoria', $categoriaId)->firstOrFail();

        // Pasar la categoría seleccionada a la vista
        return view('products', [
            'categoria' => $categoria
        ]);
    }
}
