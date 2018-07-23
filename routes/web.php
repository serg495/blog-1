<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('email/verify', 'Auth\VerificationController@verify')
    ->middleware('signed')
    ->name('email.verify');

Route::get('/posts', 'PostController@index')->name('post.index');
Route::get('/posts/{post}/show', 'PostController@show')->name('post.show');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin'], 'namespace' => 'Admin'], function (){
    Route::resource('/posts', 'PostController');
});

Route::group(['middleware' => ['role:user']], function (){
    Route::post('posts/{post}/like', 'LikeController@store')->name('like.store');
});