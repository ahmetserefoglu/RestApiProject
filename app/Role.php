<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    /**
     * User and Roles relationship
     *
     * 
     */
    public function roles()
    {
        return $this->belongsToMany('App\User','role_user');
    }
}
