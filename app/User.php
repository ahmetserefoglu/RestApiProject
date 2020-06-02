<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
	use HasApiTokens, Notifiable;

	// Rest omitted for brevity

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier() {
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims() {
		return [];
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	//,'rolename','phonenumber','verified','token','sitename','site_id','blok_id','evsahibimi'
	protected $fillable = [
		'name', 'email', 'password',
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
	public function verifyUser() {
		return $this->hasOne('App\VerifyUser');
	}

	/**
	 * User and Roles relationship
	 *
	 *
	 */
	public function roles() {
		return $this->hasOne('App\Role', 'role_user');
	}

	public function Sites() {

		return $this->belongsTo('App\Site', 'site_id');

	}

	public function products() {
		return $this->hasMany(Product::class);
	}

}
