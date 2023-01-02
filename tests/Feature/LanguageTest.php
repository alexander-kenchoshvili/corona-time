<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	use RefreshDatabase;

	public function test_if_georgian_translate_function_works()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get('/change-locale/ka');
		$response->assertSessionHas('lang', 'ka');
	}

	public function test_if_english_translate_function_works()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get('/change-locale/ru');
		$response->assertSessionHas('lang', 'en');
	}
}
