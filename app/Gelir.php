<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gelir extends Model
{
    //
    protected $table = 'gelirs';

	protected $fillable = ['gelir_adi','gelir_kisi','gelir_miktar','site_id','gelir_tarih'];

    protected $guarded = [];
}
