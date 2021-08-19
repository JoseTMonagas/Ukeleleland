<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    public $timestamps = false;
    /**
     * Returns the Asset related to that Contributor
     *
     * @return \App\Asset
     */
    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }

    /**
     * Returns the Contributor Role for that Contributor
     *
     * @return \App\ContributorRole
     */
    public function contributorRole()
    {
        return $this->belongsTo('App\ContributorRole');
    }
    
    
}
