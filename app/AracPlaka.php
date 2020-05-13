<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AracPlaka extends Model
{
    //
    protected $table = 'arac_plakas';

	protected $fillable = ['arac_sahibi','arac_plaka','site_id','blok_id','kayit_eden'];

    protected $guarded = [];
}
