<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@welcome');
Route::get('/lang/{locale}', 'HomeController@lang');

Auth::routes();

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');


Route::get('/user', 'UserController@user')->name('user')->middleware('user');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/superadmin', 'SuperAdminController@index')->middleware('superadmin');
//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'superadmin'], function () {

	Route::get('email', 'EmailController@sendEmail');

	//Route::get('faturalar', 'SuperAdminController@faturalar')->name('faturalar');
	//Route::get('gelirgider', 'SuperAdminController@gelirgider')->name('gelirgider');
	Route::get('odemeler', 'SuperAdminController@odemeler')->name('odemeler');
	Route::get('profile', 'SuperAdminController@profile')->name('profile');
	//Route::get('arizabildirim', 'SuperAdminController@arizabildirim')->name('arizabildirim');
	Route::get('raporlama', 'SuperAdminController@raporlama')->name('raporlama');
	//Route::get('siparis', 'SuperAdminController@siparis')->name('siparis');
	//Route::get('degerlendirme', 'SuperAdminController@degerlendirme')->name('degerlendirme');
	//Route::get('aracplakakayit', 'SuperAdminController@aracplakakayit')->name('aracplakakayit');
	Route::get('siteyonetim', 'SuperAdminController@siteyonetim')->name('siteyonetim');

	Route::resource('raporlama2', 'UserController');

	Route::resource('kullanicilar', 'UserController');
	Route::resource('faturalar', 'FaturaController');
	Route::resource('siteyonetim', 'SiteBlokController');
	Route::resource('site', 'SiteController');
	Route::resource('gelir', 'GelirController');

	Route::get('rapor', 'HomeController@index');

	Route::get('gelir/aidat/create', 'SuperAdminController@deneme')->name('gelir.aidat');

	Route::resource('arizabildirim', 'ArizaBildirimController');
	Route::resource('degerlendirme', 'DegerlendirmeController');
	Route::resource('aracplaka', 'AracPlakaController');
	Route::resource('siparis', 'SiparisController');
	Route::post('importarac', 'AracPlakaController@importarac')->name('aracplaka.importarac');
	Route::post('importsiparis', 'SiparisController@importsiparis')->name('siparis.importsiparis');
	Route::get('sitesakinleri/{blokid}/create', 'SiteSakinleriController@createsitesakin')->name('sitesakinleri.createsitesakin');

	Route::get('kullanicilar/{siteid}/blok', 'UserController@siteblok');

	Route::get('gelir/{blokid}/create', 'GelirController@createblok')->name('gelir.createblok');
	Route::get('faturalar/{faturatip}/create', 'FaturaController@createtip')->name('faturalar.createtip');
	Route::get('ayarlarim', 'SuperAdminController@ayarlarim')->name('ayarlarim');
	Route::get('sosyal', 'SuperAdminController@sosyal')->name('sosyal');
});
