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

Route::get('/', 'ChatsController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => ['auth']], function() {
	Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);	

	Route::group(['prefix' => 'users/{id}'], function() {
		Route::post('follow', 'UserFollowController@store')->name('user.follow');		
		Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');		
		Route::get('followings', 'UsersController@followings')->name('users.followings');
		Route::get('followers', 'UsersController@followers')->name('users.followers');
		Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
		
		Route::get('edit', 'UsersController@edit')->name('profile.edit');
    	Route::post('profile', 'UsersController@store')->name('profile.store'); // 追記
    	Route::put('profile', 'UsersController@update')->name('profile.update'); // 追記
	});

    Route::group(['prefix' => 'chats/{id}'], function() {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
		// Route::get('edit', 'ChatsController@showChatEditForm')->name('chats.edit');
		// Route::put('edit', 'ChatsController@update')->name('chats.update');
		
	});

	// Route::resource('chats', 'ChatsController', ['only' => ['store', 'destroy']]);
    Route::resource('chats', 'ChatsController', ['only' => ['store', 'edit','update', 'destroy']]);
});