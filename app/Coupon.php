<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * Returns the discount by the code
     *
     * @return App\Coupon
     */
    public static function findByCode($code)
    {
        return $this->where('code', $code)->first();
    }

    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }

    public function discountValue($total)
    {
        if ($this->discount->tipo == 'fixed') {
            return $total - $this->discount->value;
        } elseif ($this->discount->tipo == 'percent') {
            return round((intval($this->discount->value) / 100) * intval(str_replace(",", "", $total)));
        } else {
            return 0;
        }
    }

}
