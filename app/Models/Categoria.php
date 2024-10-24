<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'imagen'];

    public $timestamps = false;

    protected $primaryKey = 'id_categoria';

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}
