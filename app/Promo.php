<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
