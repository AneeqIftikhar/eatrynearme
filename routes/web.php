<?php

use App\Http\Controllers\RestaurantController;
use App\Models\Country;
use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');

// Sitemaps
Route::get('sitemap/city/{page?}', [\App\Http\Controllers\SitemapController::class, 'city']);
Route::get('sitemap/state/{page?}', [\App\Http\Controllers\SitemapController::class, 'state']);
Route::get('sitemap/restaurant/{page?}', [\App\Http\Controllers\SitemapController::class, 'restaurant']);
// Sitemaps ends

Route::get('{countrySlug?}/{stateSlug?}/{citySlug?}/{resSlug?}', [RestaurantController::class, 'restaurant'])->name('country');

Route::get('put/data', [\App\Http\Controllers\RestaurantController::class, 'putData'])->name('putData');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setstates', [RestaurantController::class, 'statesSlug']);
//Route::get('/reviews', [RestaurantController::class, 'getreviews']);

//Route::get('testImag', [RestaurantController::class, 'downloadImage']);


