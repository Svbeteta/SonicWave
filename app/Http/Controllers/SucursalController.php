<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\JsonResponse;

class SucursalController extends Controller
{
    public function index(): JsonResponse
    {
        $sucursales = Sucursal::with('geolocalizacion')->get();
        return response()->json($sucursales);
    }

    public function showSucursales()
    {
        $sucursales = Sucursal::with('geolocalizacion')->get();
        return view('oneview', compact('sucursales'));
    }

}
