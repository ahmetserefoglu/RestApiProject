<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteBlok extends Model
{
    //
    protected $guarded = [];


    public function Site(){
	 
	 return $this->belongsTo('App\Site','id');
	
	}
}
