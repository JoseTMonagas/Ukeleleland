<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
  /**
   * Get the Region of that Commune
   *
   * @return App\Region
   */
  public function region()
  {
    return $this->belongsTo('App\Region');
  }

  /**
   * Get the profiles within that Commune
   *
   * @return App\Profile
   */
  public function profiles()
  {
    return $this->hasMany('App\Profile');
  }
  
  
}
