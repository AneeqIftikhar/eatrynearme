<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getData', [App\Http\Controllers\ParseController::class, 'getData'])->name('getData');

Route::post('addCityRestaurantCount', [App\Http\Controllers\RestaurantController::class, 'addCityRestaurantCount'])->name('addCityRestaurantCount');

Route::post('googleIndexing', [App\Http\Controllers\SitemapController::class, 'googleIndexing']);

Route::post('globeImages', [App\Http\Controllers\ParseController::class, 'addImages']);
