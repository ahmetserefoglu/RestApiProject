<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siparis extends Model
{
    //
    protected $table = 'siparis';

	protected $fillable = ['siparis_konu','siparis_detay','siparis_isteyen_kisi','siparis_tarihi'];

    protected $guarded = [];
}
