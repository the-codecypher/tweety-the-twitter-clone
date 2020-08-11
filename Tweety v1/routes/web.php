<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store');

    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
    Route::delete('/tweets/{tweet}/like', 'TweetLikesController@destroy');

    Route::get('/explore', 'ExploreController');

    Route::post('/profiles/{user}/follow', 'FollowsController@store')->name('follow');
//    Route::get('/profiles/{user}/edit', 'ProfilesController@edit');
    Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->middleware('can:edit,user');
    Route::patch('/profiles/{user}', 'ProfilesController@update');
});

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');


