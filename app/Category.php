<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Returns Assets for that Category
     *
     * @return \App\Asset
     */
    public function assets()
    {
        return $this->belongsToMany('App\Asset');
    }
    
}
