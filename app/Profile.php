<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
  /**
   * Get the commune which the Profile belongs to
   *
   * @return App\Commune
   */
  public function commune()
  {
    return $this->belongsTo('App\Commune');
  }
  
  /**
   * Retorna el Usuario de es Perfil
   *
   * @return \App\User
   */
  public function user()
  {
      return $this->belongsTo('\App\User');
  }
  
}
