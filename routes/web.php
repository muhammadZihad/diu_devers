<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/frnd', function () {
    return Auth::user()->friends();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug}', 'ProfileController@show')->name('profile.show');
Route::get('/{slug}/edit', 'ProfileController@edit')->name('profile.edit');
