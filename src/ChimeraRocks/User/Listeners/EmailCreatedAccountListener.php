<?php

namespace ChimeraRocks\User\Listeners;

use ChimeraRocks\User\Events\UserCreatedEvent;
use Illuminate\Mail\Mailer;

class EmailCreatedAccountListener
{
	private $mailer;

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function handle(UserCreatedEvent $event)
	{
		$user = $event->getUser();
		$password = $event->getPassword();
		$success = $this->mailer->send('email.registration', [
			'username' => $user->email,
			'password' => $password
		], function($message) use ($user) {
			$message
			    ->to($user->email, $user->name)
				->subject("{$user->name}, sua conta foi criada!");
		});

		return $success;
	}
}