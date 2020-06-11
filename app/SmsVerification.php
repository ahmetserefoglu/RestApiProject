<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model {
	//

	protected $fillable = ['contact_number', 'code', 'status'];

	/**
	 * Kullanıcı Giriş İçin Kod ve Numarayı Kayıt Altında Tutan Metot
	 *
	 * @param[array] $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function store($request) {
		$this->fill($request->all());

		$this->save();

		$message['success'] = 'Giriş İçin Onay Kodunuzu Giriniz.';

		return response()->json(['message' => $message, 'code' => 200]);

	}

}
