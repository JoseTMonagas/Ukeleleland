<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }

    public function promos()
    {
        return $this->hasMany('App\Promo');
    }
}
