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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/signup', 'AuthController@getSignup')->name('auth.signup');
    Route::post('/signup', 'AuthController@postSignup');
    Route::get('/signin', 'AuthController@getSignin')->name('auth.signin');
    Route::post('/signin', 'AuthController@postSignin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/signout', 'AuthController@getSignout')->name('auth.signout');

    Route::get('/search', 'SearchController@getResults')->name('search.results');

    Route::get('/user/{username}', 'ProfileController@getProfile')->name('profile.index');

    Route::get('/profile/edit', 'ProfileController@getEdit')->name('profile.edit');
    Route::post('/profile/edit', 'ProfileController@postEdit');

    Route::get('/friends', 'FriendController@getIndex')->name('friend.index');
    Route::get('/friends/add/{username}', 'FriendController@getAdd')->name('friend.add');
    Route::get('/friends/accept/{username}', 'FriendController@getAccept')->name('friend.accept');

    Route::post('/status', 'StatusController@postStatus')->name('status.post');
});
// test session info
//Route::get('/alert', function () {
//    return redirect()->route('home')->with('info', 'You have signed in');
//});
