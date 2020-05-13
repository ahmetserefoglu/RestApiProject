<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $guarded = [];

    public function SiteBlok(){
	 
	 return $this->hasMany('App\SiteBlok','site_id');
	
	}

	public function Users(){
	 
	 return $this->hasMany('App\Users','user_id');
	
	}
}
