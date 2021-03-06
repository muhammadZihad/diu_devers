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

use App\Post;
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


Auth::routes();

Route::get('/demo', function () {
    return view('homepage');
});



Route::group(['middleware' => ['auth', 'complete']], function () {
    Route::get('/friendlist','ProfileController@friendlist')->name('friends');
    Route::get('/requests','ProfileController@requests')->name('requests');
    Route::get('/search', 'SearchController@view')->name('search.view');
    Route::get('/search/{sid}', 'SearchController@search2')->name('search.cat');
    Route::get('/searcher/{key}', 'SearchController@index');
    Route::post('/search', 'SearchController@search')->name('search');
    Route::resource('post', 'PostController');
    Route::get('/like/{id}/{type}', 'PostController@likeme')->name('like');
    Route::get('/unlike/{id}/{type}', 'PostController@unlikeme')->name('unlike');
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
