<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class MailNotify extends Mailable
{
	use Queueable, SerializesModels;

	public $user;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($user)
	{
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$verifyUrl = URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(
				config()->get('auth.verification.expire', 60)
			),
			[
				'id'   => $this->user->getKey(),
				'hash' => sha1($this->user->getEmailForVerification()),
			]
		);
		return $this->from('aleksandrekenchoshvili@redberry.ge', 'corona')
		->subject('verify email')
		->view('authenticate.verify-email', ['url' => $verifyUrl]);
	}
}
