<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens,Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rolename','phonenumber','verified','token','sitename','site_id','blok_id','evsahibimi'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User verify relationship
     *
     * 
     */
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    /**
     * User and Roles relationship
     *
     * 
     */
    public function roles()
    {
        return $this->hasOne('App\Role','role_user');
    }

    public function Sites(){
     
     return $this->belongsTo('App\Site','site_id');
    
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
