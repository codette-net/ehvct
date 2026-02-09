<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tour;

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

Route::get('/tours', function () {
    $tours = Tour::query()->where('is_active', true)->latest()->get();
    return view('pages.tours.index', compact('tours'));
})->name('tours.index');

Route::get('/tours/{tour:slug}', function (Tour $tour) {
    $tour->load(['variants', 'media']);
    return view('pages.tours.show', compact('tour'));
})->name('tours.show');

Route::view('/about', 'pages.about')->name('about');
Route::view('/impressions', 'pages.impressions')->name('impressions');
Route::view('/contact', 'pages.contact')->name('contact');
