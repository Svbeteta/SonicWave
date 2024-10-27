<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    protected $table = 'detallescarrito'; 

    protected $primaryKey = 'id_detalle_carrito'; 

    public $timestamps = false;

    protected $fillable = ['id_carrito', 'id_producto', 'cantidad'];

    // Relationship with Carrito
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito', 'id_carrito');
    }

    // Relationship with Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
