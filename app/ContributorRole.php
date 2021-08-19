<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributorRole extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * Returns the Contributors for that Role
     *
     * @return \App\Contributor
     */
    public function contributors()
    {
        return $this->hasMany('App\Contributor');
    }
    
}
