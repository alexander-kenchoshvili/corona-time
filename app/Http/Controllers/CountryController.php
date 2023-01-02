<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;

class CountryController extends Controller
{
	public function showCountry(): View
	{
		if (request('search'))
		{
			$countries = Country::where('name->en', 'like', '%' . request('search') . '%')
			->orwhere('name->ka', 'like', '%' . request('search') . '%')->get();
		}
		else
		{
			$countries = Country::all();
		}

		if (request('column'))
		{
			$countries = Country::orderBy(request('column') === 'name' ? request('column') . '->en' : request('column'), request('order'))->get();
		}
		$sortedAsc = request('order') === 'asc' ? 'asc' : 'asc';
		$sortedDesc = request('order') === 'desc' ? 'desc' : 'desc';

		return view('countries', [
			'countries'        => $countries,
			'sortedAsc'        => $sortedAsc,
			'sortedDesc'       => $sortedDesc,
			'new_cases'        => Country::sum('new_cases'),
			'recovered'        => Country::sum('recovered'),
			'deaths'           => Country::sum('deaths'),
		]);
	}

	public function home(): View
	{
		return view('home', [
			'countries' => Country::all(),
		]);
	}
}
