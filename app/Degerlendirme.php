<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Degerlendirme extends Model
{
    //
    use Rateable;

    protected $table = 'degerlendirmes';

	protected $fillable = ['degerlendirme_konu','degerlendirme_derece','degerlendiren_kullanici'];

    protected $guarded = [];
}
