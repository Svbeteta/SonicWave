<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geolocalizacion extends Model
{
    protected $table = 'geolocalizacion';
    protected $primaryKey = 'id_geolocalizacion';
    protected $fillable = ['latitud', 'longitud', 'direccion'];
    public $timestamps = false;

    public function direccionesUsuario()
    {
        return $this->hasMany(DireccionUsuario::class, 'id_geolocalizacion');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_geolocalizacion');
    }
}
