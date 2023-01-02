<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PasswordResetController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [CountryController::class, 'home'])->middleware('auth', 'verified')->name('show.home');
Route::get('country', [CountryController::class, 'showCountry'])->middleware('auth')->name('show.countries');
Route::get('change-locale/{locale}', [LanguageController::class, 'change'])->name('locale.change');

Route::middleware('guest')->group(function () {
	Route::view('register', 'authenticate.sign-up')->name('show.register');
	Route::post('register', [AuthController::class, 'register'])->name('users.register');
	Route::view('login', 'authenticate.sign-in')->name('login');
	Route::post('login', [AuthController::class, 'login'])->name('users.login');
	Route::view('/forgot-password', 'authenticate.reset-password')->name('password.request');
	Route::view('verify-password', 'authenticate.send-password')->name('password.send');
	Route::post('/forgot-password', [PasswordResetController::class, 'reset'])->name('password.email');
	Route::get('/reset-password/{token}', [PasswordResetController::class, 'newPasswordForm'])->name('password.reset');
	Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::view('email-verify', 'authenticate.send-email')->name('verification.notice');
Route::get('email-verify/{id}/{hash}', [AuthController::class, 'emailVerify'])->middleware(['auth', 'signed'])->name('verification.verify');
