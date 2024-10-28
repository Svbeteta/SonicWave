<?php

namespace App\Http\Controllers;

use App\Models\Geolocalizacion;
use App\Models\DireccionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionUsuarioController extends Controller
{
    public function mostrarDireccion()
    {
        $direccion = DireccionUsuario::where('id_usuario', Auth::id())
                                  ->with('geolocalizacion')
                                  ->first();

    // Retorna la vista y pasa la variable $direccion
    return view('pago', compact('direccion'));
    }

    public function guardarDireccion(Request $request)
    {
        $data = $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        // Crear o actualizar geolocalización
        $geolocalizacion = Geolocalizacion::create([
            'latitud' => $data['latitud'],
            'longitud' => $data['longitud'],
            'direccion' => "Dirección generada automáticamente",
        ]);

        // Crear la relación de dirección para el usuario
        DireccionUsuario::create([
            'id_usuario' => Auth::id(),
            'id_geolocalizacion' => $geolocalizacion->id_geolocalizacion,
        ]);

        return response()->json(['message' => 'Dirección guardada correctamente']);
    }
}
