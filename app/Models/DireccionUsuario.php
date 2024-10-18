<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionUsuario extends Model
{
    protected $fillable = ['id_usuario', 'id_geolocalizacion'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function geolocalizacion()
    {
        return $this->belongsTo(Geolocalizacion::class, 'id_geolocalizacion');
    }
}
