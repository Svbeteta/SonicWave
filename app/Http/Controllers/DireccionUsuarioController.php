<?php

namespace App\Http\Controllers;

use App\Models\Geolocalizacion;
use App\Models\DireccionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionUsuarioController extends Controller
{
    public function guardarDireccion(Request $request)
    {
        $data = $request->validate([
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'direccion' => 'required|string|max:255',
        ]);

        $geolocalizacion = Geolocalizacion::create([
            'latitud' => $data['latitud'],
            'longitud' => $data['longitud'],
            'direccion' => $data['direccion']
        ]);

        DireccionUsuario::create([
            'id_usuario' => Auth::id(),
            'id_geolocalizacion' => $geolocalizacion->id_geolocalizacion,
        ]);

        return redirect()->route('pago')->with('success', 'Dirección guardada correctamente');
    }

    public function eliminarDireccion(Request $request)
    {
        $direccion = DireccionUsuario::where('id_direccion_usuario', $request->id_direccion_usuario)
                                      ->where('id_usuario', Auth::id())
                                      ->first();

        if ($direccion) {
            $direccion->delete();
            return redirect()->route('pago')->with('success', 'Dirección eliminada exitosamente');
        }

        return redirect()->route('pago')->with('error', 'No se pudo eliminar la dirección');
    }
}
