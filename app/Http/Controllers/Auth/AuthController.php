<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SmsVerification;
use App\User;
//use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Twilio\Rest\Client;

class AuthController extends Controller {

	use VerifiesEmails;

	private $field = 'email';

	protected $code, $smsVerification;

	/*
		*
		*
	*/
	function __construct() {
		$this->smsVerification = new \App\SmsVerification();
	}

	/**
	 * Kullanıcı Kayıt İşlemleri
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
			return response()->json(['message' => $validator->errors(), 'code' => 400]);
		}

		$user = new User([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'token' => str_random(60),
			'phonenumber' => $request->phonenumber,
		]);

		$user->save();

		$user->sendApiConfirmAccount();

		$message['success'] = 'Kullanıcı Başarıyla Oluşturuldu Sisteme Giriş İçin Mailinizi Kontrol Ediniz.';

		return response()->json(['message' => $message, 'code' => 201]);
	}

	/**
	 * Kullanıcı Giriş İşlemleri
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
			return response()->json(['message' => $validator->errors(), 'code' => 400]);
		}

		$credential = $this->credentials($request);

		$credential['active'] = 1;
		$credential['deleted_at'] = null;

		if (!Auth::attempt($credential)) {

			$message['error'] = 'Email ve Şifrenizi Kontrol Ediniz.';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		$user = $request->user();

		$code = rand(1000, 9999);

		$request['code'] = $code;
		$request['contact_number'] = $user->phonenumber;

		if ($user->hasVerifiedEmail()) {

			$smsverification = $this->smsVerification::where('contact_number', $user->phonenumber)->first();

			if ($smsverification) {

				$smsverification->contact_number = $user->phonenumber;
				$smsverification->code = $code;
				$smsverification->status = false;
				$smsverification->save();

			} else {

				$this->smsVerification->store($request);
			}

			return $this->twilloApi($request);

		} else {

			$message['error'] = 'Mailinize onaylayınız';

			return response()->json(['message' => $message, 'code' => 401]);
		}

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kullanıcı Bilgileri Getir
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me() {

		$message['user'] = Auth::user();
		$message['success'] = 'Başarılı';
		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Oturumu Sonlandır
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout(Request $request) {

		$request->user()->token()->revoke();

		$smsverification = $this->smsVerification::where('contact_number', $request->user()->phonenumber)->first();

		$smsverification->delete();

		$message['success'] = 'Sistemden Çıkış Yapıldı';

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kayıtlı Kullanıcıları Getir
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

		$user = User::where('token', $request['token'])->firstOrFail();

		if ($user->hasVerifiedEmail()) {

			$message['error'] = 'Daha Önceden Email Doğrulandı';

			return response()->json(['message' => $message, 'code' => 422]);
		}

		$user->email_verified_at = now();

		$user->active = true;

		$user->token = null;

		$user->save();

		/*
			$setDelay = Carbon::parse($user->email_verified_at)->addSeconds(10);
			Bu kısımda isterseniz Kullanıcıya Hoşgeldinizi Maili İçin Gecikme Verebilirsiniz.
			Mail::queue(new \App\Mail\UserWelcome($user->name, $user->email))->delay($setDelay);
		*/

		Mail::queue(new \App\Mail\UserWelcome($user->name, $user->email));

		$message['success'] = 'Kullanıcı Email Doğrulandı';

		return response()->json(['message' => $message, 'code' => 200]);
	}

	/**
	 * Kullanıcı Girişi İçin Telefona Gelen Kod Kontrolü
	 *
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function loginVerify(Request $request) {

		$smsverification = $this->smsVerification::where('code', $request['code'])->first();

		if (!$smsverification->status) {

			$user = User::where('phonenumber', $smsverification->contact_number)->first();

			$message['success'] = "Kullanıcı giriş Yaptı";
			$message['token'] = $user->createToken('MyApp')->accessToken;
			$message['token_type'] = 'Bearer';
			$message['experies_at'] = Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString();

			$smsverification->status = true;

			$smsverification->save();

			return response()->json(['message' => $message, 'code' => 200]);

		}

		$message['error'] = "Kullanıcı Kod Geçersiz";

		return response()->json(['message' => $message, 'code' => 400]);

	}

	/**
	 * Yeniden Mail Gönderme İşlemi
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

		/*
			Yeni Bağlantı Gönderirken Yeniden Token Oluşturyoruz
		*/
		$user->token = str_random(45);

		$user->save();

		$user->sendApiConfirmAccount();

		$message['info'] = 'Yeniden Mail Gönderildi';

		return response()->json(['message' => $message, 'code' => 200]);

	}

	/**
	 * Kullanıcıdan Oturum Açmak İçin İstenilen Kullanıcı Adı
	 *
	 * @return string
	 */
	public function username() {
		return 'email';
	}

	/**
	 * Email veya PhoneNumber Kullanıcı Girişi Ayarlamak İçin
	 *
	 */
	protected function credentials(Request $request) {
		if (is_numeric($request->get('email'))) {
			return ['phonenumber' => $request->get('email'), 'password' => $request->get('password')];
		}
		return $request->only($this->username(), 'password');
	}

	/**
	 *	Oturumu Açmak İçin Telefon Numarasına Gönderilen Kod İçin Twilio Api
	 *
	 *
	 */
	protected function twilloApi($value) {

		$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
		$authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
		$contact_number = '+90' . $value->contact_number;

		try
		{
			$client = new Client($accountSid, $authToken);
			$result = $client->messages->create(

				$contact_number,
				array(
					'from' => '+17868286138',
					'body' => 'Code:' . $value->code,
				)

			);

			$mesaj = "Mesaj Başarıyla Gönderildi";

			$message['success'] = 'Mesaj Başarıyla Gönderildi';

			return response()->json(['message' => $message, 'code' => 200]);
		} catch (Exception $e) {
			$message['error'] = "Error: " . $e->getMessage();

			return response()->json(['message' => $message, 'code' => 401]);
		}

	}
}
