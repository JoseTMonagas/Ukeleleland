<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  /**
   * Get the Communes for that Region.
   *
   * @return App\Commune
   */
  public function communes()
  {
    return $this->hasMany('App\Commune');
  }
  
}
