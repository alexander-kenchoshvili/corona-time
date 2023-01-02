<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:country';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'make covid statistic';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$countries = Http::get('https://devtest.ge/countries')->collect();

		foreach ($countries as $country)
		{
			$countryFullData = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'], ])->collect();
			Country::updateOrCreate(['id' => $countryFullData['id']], [
				'name'      => $country['name'],
				'code'      => $countryFullData['code'],
				'new_cases' => $countryFullData['confirmed'],
				'recovered' => $countryFullData['recovered'],
				'deaths'    => $countryFullData['deaths'],
			]);
		}
	}
}
