<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['id_carrito', 'id_direccion_usuario', 'id_sucursal', 'total'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }

    public function direccionUsuario()
    {
        return $this->belongsTo(DireccionUsuario::class, 'id_direccion_usuario');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }
}
