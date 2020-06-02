<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
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
		]);

		$user->save();

		$message['success'] = 'Kullanıcı Başarıyla Oluşturuldu';

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
			$message['code'] = 401;

			return response()->json(['message' => $message]);
		}

		$user = $request->user();
		$message['token'] = $user->createToken('MyApp')->accessToken;
		$message['token_type'] = 'Bearer';
		$message['experies_at'] = Carbon::parse(Carbon::now()->addWeeks(1))->toDateTimeString();
		$message['success'] = 'Kullanıcı Girişi Başarılı';

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
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh() {
		return $this->respondWithToken(auth()->refresh());
	}

	/**
	 * Response Token
	 *
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken() {

	}
}
