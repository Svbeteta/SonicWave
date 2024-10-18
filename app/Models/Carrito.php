<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['id_usuario', 'estado', 'total'];

    public function detallesCarrito()
    {
        return $this->hasMany(DetalleCarrito::class, 'id_carrito');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
