<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * Returns Images for that Type
     *
     * @return \App\Image
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    
}
