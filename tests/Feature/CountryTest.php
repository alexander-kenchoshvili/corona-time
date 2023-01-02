<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	use RefreshDatabase;

	public function test_country_page_is_accessible()
	{
		$user = User::factory()->create();
		$this->actingAs($user)->get(route('show.countries'))->assertSuccessful();
	}

	public function test_if_search_by_country_is_accessible()
	{
		$user = User::factory()->create();
		Country::create([
			'name'      => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'deaths'    => 2,
			'new_cases' => 3,
			'recovered' => 4,
		]);
		$response = $this->actingAs($user)->get(route('show.countries', [
			'search' => 'Georgia',
		]));
		$response->assertSee('Georgia');
		$response->assertSuccessful();
	}

	public function test_if_sort_function_works_with_asc()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get('country?column=name&order=asc');
		$response->assertSuccessful();
	}

	public function test_if_sort_function_works_with_desc()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get('country?column=name&order=desc');
		$response->assertSuccessful();
	}

	public function test_if_home_page_is_accesible_with_data()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get(route('show.home'), [
			'countries' => Country::all(),
		]);
		$response->assertSuccessful();
	}
}
