<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetImage extends Model
{
    public $timestamps = false;
    /**
     * Returns the Type for that Image
     *
     * @return \App\ImageType
     */
    public function type()
    {
        return $this->belongsTo('App\ImageType');
    }
    
    /**
     * Returns the Asset for that Image
     *
     * @return \App\Asset
     */
    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }
    
}
