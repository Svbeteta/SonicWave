<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    
    protected $fillable = ['nombre', 'id_geolocalizacion'];

    public function geolocalizacion()
    {
        return $this->belongsTo(Geolocalizacion::class, 'id_geolocalizacion');
    }
}
