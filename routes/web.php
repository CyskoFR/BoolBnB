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
    });

Route::get('{any?}',function(){
    return view('guest.home');
})->where('any','.*');