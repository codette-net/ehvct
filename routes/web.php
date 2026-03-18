<?php

use App\Http\Controllers\SiteMapController;
use Illuminate\Support\Facades\Route;
use App\Models\Tour;
use App\Http\Controllers\MollieWebhookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TourPublicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingCancelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;


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
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/', [TourPublicController::class, 'toursForHome'])->name('home');

Route::get('/tours', [TourPublicController::class, 'index'])->name('tours.index');
Route::get('/tours/{tour:slug}', [TourPublicController::class, 'show'])->name('tours.show');

// Booking
Route::get('/book/{slot}',[BookingController::class, 'create'])->name('bookings.create');
Route::post('/book/{slot}',[BookingController::class, 'store'])->name('bookings.store');

// Booking status
Route::get('booking/{reference}',[BookingController::class, 'status'])
    ->name('bookings.status');
Route::get('/booking/{reference}/status.json', [BookingController::class, 'statusJson'])
    ->name('bookings.status.json');

// Booking cancel
Route::get('booking/{reference}/cancel',[BookingCancelController::class, 'request'])
    ->middleware('signed')
    ->name('bookings.cancel.request');
Route::post('booking/{reference}/cancel',[BookingCancelController::class, 'submit'])
    ->middleware('signed')
    ->name('bookings.cancel.submit');


// Success page
Route::get('/payment/success/{reference}', [PaymentController::class, 'success'])->name('payment.success');

// mollie webhooks
Route::post('/webhooks/mollie', MollieWebhookController::class)->name('webhooks.mollie');

Route::view('/about', 'pages.about')->name('about');
Route::view('/impressions', 'pages.impressions')->name('impressions');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])
    ->middleware('throttle:5,1') // max 5 msg p/m
    ->name('contact.submit');

Route::post('/webhooks/mollie', MollieWebhookController::class)->name('webhooks.mollie');
Route::get('/payment/success/{reference}', [PaymentController::class, 'success'])->name('payment.success');

// policies
Route::view('/privacy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms', 'pages.terms-of-service')->name('terms-of-service');
Route::view('/cookies', 'pages.cookies')->name('cookies');
