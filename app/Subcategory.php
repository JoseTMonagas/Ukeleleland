<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

  /**
   * Returns the Products of that Subcategory
   *
   * @return Collection App\Product
   */
  public function products()
  {
    return $this->hasMany('App\Product');
  }

}
