<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
	public function register(RegistrationRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());
		Mail::to($user->email)->send(new MailNotify($user));

		auth()->login($user);

		return redirect(route('verification.notice'));
	}

	public function emailVerify(EmailVerificationRequest $request): RedirectResponse
	{
		$request->fulfill();
		return redirect(route('show.home'));
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$user = $request->validated();
		$loginInput = filter_var($request->username, FILTER_VALIDATE_EMAIL) ?
		'email' : 'username';
		if (auth()->attempt([$loginInput => $user['username'], 'password' => $user['password']], $request->get('remember')))
		{
			return redirect(route('show.home'));
		}
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();
		return redirect(route('login'));
	}
}
