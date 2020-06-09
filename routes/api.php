<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group([
	'namespace' => 'Auth',
	'prefix' => 'auth',

], function () {

	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::get('email/verify/{token}', 'AuthController@verify')->name('verification.verify');
	Route::get('login/verify/{code}', 'AuthController@loginVerify');
	Route::get('email/resend/{email}', 'AuthController@resend');

	Route::group(['middleware' => 'auth:api'], function () {

		Route::post('logout', 'AuthController@logout');
		Route::get('users', 'AuthController@getAllUser')->middleware('verified');
		Route::get('me', 'AuthController@me');
	});

});

/*
Bu Grup tanımında ise password yenileme
 */

Route::group([
	'namespace' => 'Auth',
	'prefix' => 'password',

], function () {

	Route::post('sendtoken', 'ResetPasswordController@store');
	Route::get('find/{token?}', 'ResetPasswordController@find');
	Route::post('resetpassword', 'ResetPasswordController@resetpassword');

});

/*Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
Route::get('logout', 'ApiController@logout');

Route::get('user', 'ApiController@getAuthUser');

Route::get('products', 'ProductController@index');
Route::get('products/{id}', 'ProductController@show');
Route::post('products', 'ProductController@store');
Route::put('products/{id}', 'ProductController@update');
Route::delete('products/{id}', 'ProductController@destroy');
});*/
