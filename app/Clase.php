<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = ['fecha_clase', 'duracion', 'tarifa', 'observaciones'];

    public function tutoria ()
    {
        return $this->belongsTo('\App\Tutoria');
    }
}
