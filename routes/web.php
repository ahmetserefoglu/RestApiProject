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

Route::get('/', function () {
	return view('welcome');
});

Route::get('share-post', function () {
	/**
	 * Post Oluşturma vb. diğer işlemler
	 */
	for ($i = 0; $i < 10; $i++) {
		# e-posta göndermek yerine 1 saniye gecikme ekliyoruz.
		sleep(1);
	}

	return 'Gönderiniz yayınlandı';
});

Route::get('share-post-with-queue', function () {
	/**
	 * Post Oluşturma vb. diğer işlemler
	 */
	for ($i = 0; $i < 10; $i++) {
		App\Jobs\SendEmailJob::dispatch();
	}

	return 'Gönderiniz yayınlandı.';
});