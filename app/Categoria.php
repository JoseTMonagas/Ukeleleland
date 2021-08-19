<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * Retorna la lista de Productos de esa Categoria
     *
     * @return \App\Product
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    
}
