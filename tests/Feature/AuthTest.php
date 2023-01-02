<?php

namespace Tests\Feature;

use App\Mail\MailNotify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	use Notifiable;

	use HasApiTokens;

	public function test_register_page_is_accessible()
	{
		$response = $this->get(route('show.register'));
		$response->assertSuccessful();
	}

	public function test_auth_should_give_us_errors_if_input_is_not_provided()
	{
		$response = $this->post(route('users.register'));

		$response->assertSessionHasErrors(
			[
				'username',
				'email',
				'password',
			]
		);
	}

	public function test_auth_should_give_us_email_error_if_we_wont_provide_email_input()
	{
		$response = $this->post(route('users.register'), [
			'password'              => 'my-password',
			'password_confirmation' => 'my-password',
			'username'              => 'username',
		]);
		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password', 'username']);
	}

	public function test_auth_should_give_us_username_error_if_we_wont_provide_username_input()
	{
		$response = $this->post(route('users.register'), [
			'password'              => 'my-password',
			'password_confirmation' => 'my-password',
			'email'                 => 'test@gmail.com',
		]);
		$response->assertSessionHasErrors(
			[
				'username',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password', 'email']);
	}

	public function test_auth_should_give_us_password_error_if_we_wont_provide_password_input()
	{
		$response = $this->post(route('users.register'), [
			'username'              => 'username',
			'email'                 => 'test@gmail.com',
		]);
		$response->assertSessionHasErrors(
			[
				'password',
			]
		);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_auth_should_give_us_email_error_when_email_field_is_not_correct()
	{
		$response = $this->post(route('users.register'), [
			'email' => 'testgmail.com',
		]);

		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_auth_should_give_us_incorrect_credentials_error_when_such_email_already_exists()
	{
		$user1 = User::factory()->create([
			'username'              => 'gela',
			'email'                 => 'mail@gmail.com',
			'password'              => 'password',
		]);

		$response = $this->post(route('users.register'), [
			'username'              => 'gocha',
			'email'                 => $user1->email,
			'password'              => 'pass',
		]);
		$response->assertSessionHasErrors([
			'email' => 'The email has already been taken.',
		]);
	}

	public function test_auth_should_give_us_incorrect_credentials_error_when_such_user_already_exists()
	{
		$user1 = User::factory()->create([
			'username'              => 'gela',
			'email'                 => 'test@gmail.com',
			'password'              => 'password',
		]);

		$response = $this->post(route('users.register'), [
			'username'              => 'gela',
			'email'                 => $user1->email,
			'password'              => 'pass',
		]);
		$response->assertSessionHasErrors([
			'username',
		]);
	}

	public function test_auth_should_give_us_incorrect_credentials_error_when_password_does_not_match()
	{
		$user = User::factory()->make();
		$response = $this->post(
			route('users.register'),
			[
				'username'              => $user->username,
				'email'                 => $user->email,
				'password'              => $user->password,
				'password_confirmation' => '12345',
			]
		);
		$response->assertSessionHasErrors([
			'password',
		]);
	}

	public function test_auth_should_redirect_to_send_email_page_after_successfull_register()
	{
		$user = User::factory()->make();
		$response = $this->post(
			route('users.register'),
			[
				'username'              => $user->username,
				'email'                 => $user->email,
				'password'              => $user->password,
				'password_confirmation' => $user->password,
			]
		);
		$this->assertAuthenticated();
		$response->assertRedirect(route('verification.notice'));
	}

	public function test_registration_link_is_valid()
	{
		$this->withoutExceptionHandling();
		$user = User::factory()->create();
		Mail::fake();
		Mail::to($user)->send(new MailNotify($user));
		Mail::assertSent(MailNotify::class);
	}

	public function test_verify_email()
	{
		$user = User::factory()->create([
			'email_verified_at' => null,
		]);
		$verifyUrl = URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(
				config()->get('auth.verification.expire', 60)
			),
			[
				'id'   => $user->id,
				'hash' => sha1($user->email),
			]
		);
		$response = $this->actingAs($user)->get($verifyUrl);
		$response->assertRedirect(route('show.home'));
	}

	public function test_login_page_is_accessible()
	{
		$response = $this->get(route('login'));
		$response->assertSuccessful();
	}

	public function test_auth_should_give_us_errors_if_login_input_is_not_provided()
	{
		$response = $this->post(route('users.login'));

		$response->assertSessionHasErrors(
			[
				'username',
				'password',
			]
		);
	}

	public function test_auth_should_give_us_user_error_if_we_wont_provide_user_input()
	{
		$response = $this->post(route('users.login'), [
			'password'              => 'my-password',
		]);
		$response->assertSessionHasErrors(
			[
				'username',
			]
		);
		$response->assertSessionDoesntHaveErrors(['password']);
	}

	public function test_login_should_give_us_password_error_if_we_wont_provide_password_input()
	{
		$response = $this->post(route('users.login'), [
			'username' => 'alex',
		]);
		$response->assertSessionHasErrors([
			'password',
		]);
	}

	public function test_login_should_give_us_password_error_if_we_wont_provide_correct_password_input()
	{
		$user = User::factory()->create();
		$response = $this->post(route('users.login'), [
			'username' => $user->username,
			'password' => '12',
		]);

		$response->assertSessionHasErrors([
			'password',
		]);
	}

	public function test_login_should_give_us_incorrect_credentials_error_when_such_user_does_not_exists()
	{
		$response = $this->post(route('users.login'), [
			'username' => 'alex',
			'password' => 'password',
		]);
		$response->assertSessionHasErrors([
			'username' => 'The selected username is invalid.',
		]);
	}

	public function test_login_should_redirect_home_page_after_successful_login()
	{
		$this->withoutExceptionHandling();
		$username = 'alexander';
		$password = '123456';

		User::factory()->create(
			[
				'username' => $username,
				'password' => $password,
			]
		);
		$response = $this->post(route('users.login'), [
			'username' => $username,
			'password' => $password,
		]);
		$response->assertValid();
		$this->assertAuthenticated();

		$response->assertRedirect(route('show.home'));
	}

	public function test_login_should_redirect_home_page_after_successful_login_with_email()
	{
		$this->withoutExceptionHandling();
		$email = 'alexander@gmail.com';
		$password = '123456';

		User::factory()->create(
			[
				'email'       => $email,
				'password'    => $password,
			]
		);
		$response = $this->post(route('users.login'), [
			'username'    => $email,
			'password'    => $password,
		]);
		$response->assertValid();
		$this->assertAuthenticated();

		$response->assertRedirect(route('show.home'));
	}

	public function test_remember_me_functionality()
	{
		$email = 'test@gmail.com';
		$password = '1234';

		$user = User::factory()->create([
			'id'       => random_int(1, 100),
			'password' => bcrypt($password),
			'email'    => $email,
		]);

		$response = $this->post(route('users.login'), [
			'email'    => $email,
			'password' => $password,
			'remember' => 'on',
		]);

		$response->assertRedirect(route('show.home'));
	}

	public function test_when_user_is_not_logged_in_dont_let_him_to_the_logout_route()
	{
		$this->get(route('logout'))->assertRedirect(route('login'));
	}

	public function test_user_can_successfully_logout()
	{
		$user = User::factory()->create();
		$this->actingAs($user)->get(route('logout'))->assertRedirect(route('login'));
	}

	public function test_forgot_password_page_is_accessible()
	{
		$response = $this->get(route('password.request'));
		$response->assertSuccessful();
	}

	public function test_reset_password_email_does_not_have_correct_structure()
	{
		$response = $this->post(route('password.request'), [
			'email' => 'testgmail.com',
		]);

		$response->assertSessionHasErrors(
			[
				'email',
			]
		);
	}

	public function test_forgot_password_page_should_give_us_error_if_email_does_not_exists()
	{
		$response = $this->post(route('password.request'));
		$response->assertSessionHasErrors([
			'email',
		]);
	}

	public function test_forgot_password_page_should_redirect_to_verify_password_page_if_email_exists()
	{
		$email = 'test@gmail.com';
		User::factory()->create([
			'email' => $email,
		]);
		$response = $this->post(route('password.email'), [
			'email' => $email,
		]);
		$response->assertRedirect(route('password.send'));
	}

	public function test_user_receives_an_email_with_a_password_reset_link()
	{
		$this->withoutExceptionHandling();
		User::factory()->create([
			'email'    => 'test@gmail.com',
			'password' => bcrypt('1234'),
		]);
		$token = Password::createToken(User::first());
		Event::fake();
		$response = $this->post(route('password.update'), [
			'email'                       => 'test@gmail.com',
			'password'                    => '123456',
			'password_confirmation'       => '123456',
			'token'                       => $token,
		]);
		$response->assertRedirect(route('login'));
		$this->assertTrue(Hash::check('123456', User::first()->password));
		$this->assertFalse(Hash::check('1234', User::first()->password));
	}

	public function test_if_reset_password_page_is_accessible()
	{
		$user = User::factory()->create();
		$token = Password::createToken($user);
		$response = $this->get(route('password.reset', [
			'token' => $token,
		]));
		$response->assertSuccessful();
	}
}
