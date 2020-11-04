<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotify;
use App\Notifications\ResetPasswordSuccess;
use App\ResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller {
	//

	/**
	 * ResetPassword Token Store
	 *
	 * @param[string] email
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function store(Request $request) {

		$rules = [
			'email' => 'required|string|email|exists:users'
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {

			$message['errors'] = $validator->errors();
			return response()->json(['message' => $message, 'code' => 400]);
		}

		$user = User::where('email', $request['email'])->first();

		if (!$user) {

			$message['error'] = 'Mail Adresi Bulunamadı';

			return response()->json(['message' => $message, 'code' => 404]);
		}

		$resetpassword = ResetPassword::updateOrCreate(
			[
				'email' => $user->email,
			],
			[
				'email' => $user->email,
				'token' => str_random(45),
			]
		);

		if ($user && $resetpassword) {

			$user->notify(new ResetPasswordNotify($resetpassword->token));

		}

		$message['success'] = 'Email Şifre Yenileme Linki Gönderildi';

		return response()->json(['message' => $message, 'code' => 201]);
	}

	/**
	 * Find Token
	 *
	 * @param[string] token
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function find($token) {

		$resetpassword = ResetPassword::where('token', $token)->first();

		if (!$token) {

			$message['error'] = 'Token Geçersiz';

			return response()->json(['message' => $message, 'code' => 404]);
		}

		if (Carbon::parse($resetpassword->created_at)->addMinutes(720)->isPast()) {

			$resetpassword->delete();
			$message['error'] = 'Token Geçersiz';

			return response()->json(['message' => $message, 'code' => 404]);

		}

		$message['success'] = 'Başarılı';

		return response()->json(['resetpassword' => $resetpassword, 'code' => 200]);
	}

	/**
	 * ResetPassword Token Store
	 *
	 * @param[string] email
	 * @param[string] password
	 * @param[string] token
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function resetpassword(Request $request) {

		$rules = [
			'email' => 'required|string|email|exists:users',
			'token' => 'required|string',
			'password' => 'required|string|min:6|confirmed',
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {

			$message['errors'] = $validator->errors();
			return response()->json(['message' => $message, 'code' => 400]);
		}

		$resetpassword = ResetPassword::updateOrCreate(
			[
				'email' => $request->email,
				'token' => $request->token,
			]
		)->first();

		if (!$resetpassword) {

			$message['error'] = 'Mail Adresi Bulunamadı';

			return response()->json(['message' => $message, 'code' => 404]);
		}

		$user = User::where('email', $resetpassword->email)->first();

		if (!$user) {

			$message['error'] = 'Kullanıcı Bulunamadı';

			return response()->json(['message' => $message, 'code' => 404]);

		}

		$user->password = bcrypt($request->password);
		$user->save();

		$resetpassword->delete();

		$user->notify(new ResetPasswordSuccess($resetpassword->token));

		$message['success'] = 'Kullanıcı Şifresi Başarıyla Değiştirildi.';

		return response()->json(['message' => $message, 'code' => 201]);
	}
}
