<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as AccountVerifyBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

/**
 * Account Verify
 */
class AccountVerify extends AccountVerifyBase {

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		$verificationUrl = $this->verificationUrl($notifiable);

		return (new MailMessage)
			->greeting(Lang::getFromJson('Merhaba'))
			->subject(Lang::getFromJson('E-Posta Doğrulayın'))
			->line(Lang::getFromJson('E-posta adresinizi doğrulamak için lütfen aşağıdaki linke tıklayın.'))
			->action(Lang::getFromJson('E-posta Doğrulayın'), $verificationUrl);
	}

	/**
	 * Get The verification URL for
	 *
	 * @param mixed $notifiable
	 *
	 */
	protected function verificationUrl($notifiable) {
		return URL::temporarySignedRoute('verification.verify',
			Carbon::now()->addMinutes(60), ['token' => $notifiable->token]
		);
	}
}