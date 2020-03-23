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

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'notwelcome']], function () {
    Route::get('/welcome', 'ProfileController@welcome')->name('welcome');
    Route::post('/welcome/store', 'ProfileController@welcome_store')->name('w_store');
});


// Route::get('login', 'AuthController@index')->name('login');
// Route::post('post-login', 'AuthController@postLogin');
// Route::get('registration', 'AuthController@registration')->name('register');
// Route::post('post-registration', 'AuthController@postRegistration');
// Route::get('dashboard', 'AuthController@dashboard')->name('dash');
// Route::post('logout', 'AuthController@logout')->name('logout');
Auth::routes();


Route::group(['middleware' => ['auth', 'complete']], function () {
    Route::get('/friends', 'FriendController@friends');
    Route::get('/friends_paginate', 'FriendController@friends_paginate');
    Route::post('/profileimage/store', 'ProfileController@image_change')->name('image-save');
    Route::get('/friend_status/{id}', 'FriendController@friendship_status');
    Route::get('/accept_request/{id}', 'FriendController@accept_friend');
    Route::get('/add_friend/{id}', 'FriendController@add_friend');
    Route::get('/unfriend/{id}', 'FriendController@unfriend');
    Route::get('/friend_requests/{id}', 'FriendController@friend_requests');
    Route::get('/cancel_request/{id}', 'FriendController@cancel_request');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/{slug}', 'ProfileController@show')->name('profile.show');
    Route::get('/{slug}/edit', 'ProfileController@edit')->name('profile.edit');
});
