<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

	use VerifiesEmails;

	//
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	/*public function __construct() {
		$this->middleware('auth:api', ['except' => ['login']]);
	}*/

	/**
	 * Kullanıcı Kayıt
	 *
	 * @param[string] name
	 * @param[string] email
	 * @param[string] password
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function register(Request $request) {

		$rules = [
			'name' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|string',
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$user = new User([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'activation_token' => str_random(60),
		]);

		$user->save();

		$user->sendApiConfirmAccount();

		$message['success'] = 'Kullanıcı Başarıyla Oluşturuldu Sisteme Giriş İçin Mailinize Kontrol Ediniz.';

		return response()->json(['message' => $message, 'code' => 201]);
	}

	/**
	 * Kullanıcı Girişi
	 *
	 * @param[string] email
	 * @param[string] password
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	public function login(Request $request) {

		$rules = [
			'email' => 'required|string|email',
			'password' => 'required|string',
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$credentials = request(['email', 'password']);

		if (!Auth::attempt($credentials)) {

			$message['error'] = 'Unauthorized';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		$user = $request->user();

		if ($user->hasVerifiedEmail()) {

			$message['token'] = $user->createToken('MyApp')->accessToken;
			$message['token_type'] = 'Bearer';
			$message['experies_at'] = Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString();
			$message['success'] = 'Kullanıcı Girişi Başarılı';

		} else {

			$message['error'] = 'Mailinize onaylayınız';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me() {

		$message['user'] = Auth::user();
		$message['success'] = 'Başarılı';
		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout(Request $request) {

		$request->user()->token()->revoke();
		$message['success'] = 'Sistemden Çıkış Yapıldı';

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * All user
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAllUser() {

		$message['users'] = User::all();
		$message['success'] = "Kullanıcılar çağırıldı";

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kullanıcı Onaylama
	 *
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function verify(Request $request) {

		$user = User::findOrFail($request['id']);

		$user->email_verified_at = now();

		$user->save();

		$message['success'] = 'Kullanıcı Email Doğrulandı';

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Yeniden Mail Gönderme
	 *
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function resend(Request $request) {

		$rules = [
			'email' => 'required|string|email',
			'email' => 'exists:users',
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json(['message' => $validator->errors(), 'code' => 400]);
		}

		$user = User::where('email', $request['email'])->first();

		if ($user->hasVerifiedEmail()) {

			$message['info'] = 'Daha Önceden Email Doğrulandı';

			return response()->json(['message' => $message, 'code' => 422]);

		}

		$user->sendApiConfirmAccount();

		$message['info'] = 'Yeniden Mail Gönderildi';

		return response()->json(['message' => $message, 'code' => 200]);

	}
}
