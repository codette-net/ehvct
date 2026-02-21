<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tour;
use App\Http\Controllers\MollieWebhookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TourPublicController;


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


Route::view('/', 'pages.home')->name('home');
Route::view('/logoding', 'pages.logoding')->name('logoding');

Route::get('/tours', [TourPublicController::class, 'index'])->name('tours.index');
Route::get('/tours/{tour:slug}', [TourPublicController::class, 'show'])->name('tours.show');

Route::view('/about', 'pages.about')->name('about');
Route::view('/impressions', 'pages.impressions')->name('impressions');
Route::view('/contact', 'pages.contact')->name('contact');


Route::post('/webhooks/mollie', MollieWebhookController::class)->name('webhooks.mollie');
Route::get('/payment/success/{reference}', [PaymentController::class, 'success'])->name('payment.success');
