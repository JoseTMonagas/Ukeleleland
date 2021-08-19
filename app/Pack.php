<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    /**
     * Retorna el Producto de ese Pack
     *
     * @return \App\Product
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Retorna los Accesorios de ese Pack
     *
     * @return \App\Accesorio
     */
    public function accesorios()
    {
        return $this->belongsToMany('App\Accesorio');
    }
    
    
}
