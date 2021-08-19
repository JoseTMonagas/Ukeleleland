<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    /**
     * Retorna los Packs de ese Accesorio
     *
     * @return \App\Pack
     */
    public function packs()
    {
        return $this->belongsToMany('App\Pack');
    }
    
}
