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

	'prefix' => 'auth',

], function () {

	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::get('email/verify/{id}', 'AuthController@verify')->name('verification.verify');

	Route::group(['middleware' => 'auth:api'], function () {

		Route::post('logout', 'AuthController@logout');
		Route::get('users', 'AuthController@getAllUser');
		Route::get('me', 'AuthController@me');
	});

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
