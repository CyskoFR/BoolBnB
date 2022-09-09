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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('apartments', 'Api\ApartmentController@index');

Route::get('apartments/sponsored', 'Api\ApartmentController@sponsored');

Route::get('apartments/search', 'Api\ApartmentController@searchApartment');

Route::get('apartment/{any?}', 'Api\ApartmentController@getApartment');

Route::get('service/{any?}', 'Api\ApartmentController@getServices');

Route::get('categories', 'Api\CategoryController@index');

Route::get('services', 'Api\ServiceController@index');

//store dei messaggi
Route::post('message' , 'Api\MessageController@store');

//transazioni
Route::get('sponsorships/generate', 'Api\SponsorshipController@generate');
Route::post('sponsorships/make/payment', 'Api\SponsorshipController@makePayment');

