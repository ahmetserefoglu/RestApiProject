<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as AccountVerifyBase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

/**
 * Account Verify
 */
class AccountVerifyUser extends AccountVerifyBase {

	/**
	 * Get The verification URL for
	 *
	 * @param mixed $notifiable
	 *
	 */
	protected function verificationUrl($notifiable) {
		return URL::temporarySignedRoute('verification.resend',
			Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
		);
	}
}