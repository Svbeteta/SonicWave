<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías de la base de datos
        $categorias = Categoria::all();

        // Pasar las categorías a la vista 'oneview'
        return view('oneview', compact('categorias'));
    }
}
