<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchDataTest extends TestCase
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	use RefreshDatabase;

	public function test_if_data_is_accessible()
	{
		Http::fake([
			'https://devtest.ge/countries' => Http::response(json_encode([
				[
					'name' => [
						'ka' => 'საქართველო',
						'en' => 'Georgia',
					],
					'code' => 'GE',
				],
			])),
			'https://devtest.ge/get-country-statistics' => Http::response(json_encode([
				'country'   => 'Georgia',
				'code'      => 'GE',
				'deaths'    => 25,
				'recovered' => 300,
				'confirmed' => 1500,
				'id'        => 1,
			])),
		]);
		$this->artisan('make:country')->assertSuccessful();
	}
}
