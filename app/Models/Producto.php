<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';

    protected $table = 'productos';

    protected $fillable = ['nombre', 'descripcion', 'precio', 'id_categoria', 'imagen', 'slug'];

    public $timestamps = false; // Disable timestamps to avoid 'updated_at' issues

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
