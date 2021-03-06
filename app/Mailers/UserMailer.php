<?php

namespace App\Mailers;

use App\Mailers\Contracts\Mailable;
use App\Mailers\Contracts\ConfirmableUser;

class UserMailer extends Mailer
{
	public function sendWelcomeEmailTo(Mailable $user)
	{
		$view = 'emails.users.welcome';
		$subject =  '[' . config('app.name') . '] Welcome!';

		$this->sendTo($user, $view, $subject, [
			'name' => $user->getName()
		]);
	}

	public function sendConfirmationEmailTo(ConfirmableUser $user)
	{
		$view = 'emails.users.confirmation';
		$subject = '[' . config('app.name') . '] Confirm your email';

		$this->sendTo($user, $view, $subject, [
			'code' => $user->getConfirmationCode()
		]);
	}
}