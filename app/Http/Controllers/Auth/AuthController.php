<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

	use VerifiesEmails;

	private $field = 'email';
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
			'password' => 'required|string|min:6|confirmed',
			'phonenumber' => 'required|string|min:10|unique:users',
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
			'phonenumber' => $request->phonenumber,
		]);

		$user->save();

		$user->sendApiConfirmAccount();

		$message['success'] = 'Kullanıcı Başarıyla Oluşturuldu Sisteme Giriş İçin Mailinizi Kontrol Ediniz.';

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
			'password' => 'required|string',
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$credential = $this->credentials($request);

		$credentials['active'] = 1;
		$credentials['deleted_at'] = null;

		if (!Auth::attempt($credential)) {

			$message['error'] = 'Email ve Şifrenizi Kontrol Ediniz.';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		$user = $request->user();

		if ($user->hasVerifiedEmail()) {

			$code = rand(1000, 9999);
			$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
			$authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
			try
			{
				$client = new Client(['auth' => [$accountSid, $authToken]]);
				$result = $client->post('https://api.twilio.com/2010-04-01/Accounts/AC037e3b3a9f8743ee90adb2283e7c8402/Messages.json',
					[
						'headers' => [
							'Content-Type' => 'application/x-www-form-urlencoded',
						],
						'form_params' => [
							'Body' => 'CODE: ' . $code, //set message body
							'To' => '05535345272',
							'From' => '+13344599247', //we get this number from twilio
						]]);
				//$result[0]
				$mesaj = "Mesaj Başarıyla Gönderildi";

				$message['success'] = 'Mesaj Başarıyla Gönderildi';

				return response()->json(['message' => $message, 'code' => 200]);
			} catch (Exception $e) {
				$message['error'] = "Error: " . $e->getMessage();

				return response()->json(['message' => $message, 'code' => 401]);
			}
			/*$message['token'] = $user->createToken('MyApp')->accessToken;
				$message['token_type'] = 'Bearer';
				$message['experies_at'] = Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString();
			*/

		} else {

			$message['error'] = 'Mailinize onaylayınız';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kullanıcı Bilgileri
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me() {

		$message['user'] = Auth::user();
		$message['success'] = 'Başarılı';
		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Oturumu Kapat
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout(Request $request) {

		$request->user()->token()->revoke();
		$message['success'] = 'Sistemden Çıkış Yapıldı';

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kayıtlı Kullanıcılar
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAllUser() {

		$message['users'] = User::all();
		$message['success'] = "Kullanıcılar çağırıldı";

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kullanıcı Email Onaylama
	 *
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function verify(Request $request) {

		$user = User::findOrFail($request['id']);

		if ($user->hasVerifiedEmail()) {
			$message['error'] = 'Daha Önceden Email Doğrulandı';

			return response()->json(['message' => $message, 'code' => 422]);
		}

		$user->email_verified_at = now();

		$user->active = true;

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

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function username() {
		return 'email';
	}

	/**
	 * Email veya PhoneNumber Girişi
	 *
	 */
	protected function credentials(Request $request) {
		if (is_numeric($request->get('email'))) {
			return ['phonenumber' => $request->get('email'), 'password' => $request->get('password')];
		}
		return $request->only($this->username(), 'password');
	}
}
