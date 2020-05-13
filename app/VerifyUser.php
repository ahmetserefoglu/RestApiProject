<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    //
    protected $guarded = [];

    protected $table='verify_users';

    protected $fillable = [
        'user_id', 'token'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
