<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\SendResetLinkRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
	public function reset(SendResetLinkRequest $request): RedirectResponse
	{
		$validEmail = $request->validated();
		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
				? redirect(route('password.send'))->with(['status' => __($status)])
				: back()->withErrors(['email' => __('validation.email')]);
	}

	public function newPasswordForm($token): View
	{
		return view('authenticate.new-password', ['token' => $token, 'email' => request('email')]);
	}

	public function resetPassword(PasswordResetRequest $request): RedirectResponse
	{
		Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));
				$user->save();
				event(new PasswordReset($user));
			}
		);
		return redirect(route('login'));
	}
}
