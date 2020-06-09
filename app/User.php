<?php

namespace App;

use App\Notifications\AccountVerify;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {

	use HasApiTokens, Notifiable, SoftDeletes;

	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'phonenumber', 'token', 'active',
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

	public function products() {
		return $this->hasMany(Product::class);
	}

	/**
	 *
	 * Kullanıcı Doğrulama İçin Çalışan Notification
	 *
	 */
	public function sendApiConfirmAccount() {
		$this->notify(new AccountVerify);
	}

	public function resendApiConfirmAccount() {
		$this->notify(new AccountVerifyUser);
	}

}
