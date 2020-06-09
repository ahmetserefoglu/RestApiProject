<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/*
 *
 * Şifre Yenileme Linki Göndermek İçin Kullandığımız Sınıf
 * Burada ShouldQueue sınıfını implement etmemiz bize mail göndermelerde işlemleri kuyruğa alarak işlem yapıyor
 */
class ResetPasswordNotify extends Notification implements ShouldQueue {
	use Queueable;

	protected $token;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($token) {
		$this->token = $token;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		$url = url('/api/password/find/' . $this->token);

		return (new MailMessage)
			->line('Şifrenizi Yenilemek İçin Butona Tıklayın')
			->action('Değiştirme Linki', url($url))
			->line('Uygulamamızı Kullandığınız İçin Teşekkür Ederiz!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
