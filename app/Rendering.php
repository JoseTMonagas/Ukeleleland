<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendering extends Model
{
    public $timestamps = false;
    /**
     * Returns the related Assets
     *
     * @return \App\Asset
     */
    public function assets()
    {
        return $this->belongsToMany('App\Asset');
    }
    
}
