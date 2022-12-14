<?php

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

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('apartments', 'ApartmentController');
        //index messaggi per il singolo appartamento;
        Route::get('/apartments/{apartment}/messages', 'MessageController@index')->name('messages');
        Route::get('/apartments/{apartment}/messages/{message}', 'MessageController@show')->name('message.show');
        Route::delete('/apartments/{apartment}/messages/{message}', 'MessageController@destroy')->name('message.destroy');
        //index sponsorships;
        Route::get('/apartments/{apartment}/sponsorships', 'SponsorshipController@index')->name('sponsorships');
        Route::post('/apartments/{apartment}/sponsorships/checkout', 'SponsorshipController@checkout')->name('sponsorships.checkout');
        Route::get('/apartments/{apartment}/sponsorships/checkout/result', 'SponsorshipController@checkout')->name('sponsorships.transactionResult');
        
    });

Route::get('{any?}',function(){
    return view('guest.home');
})->where('any','.*');