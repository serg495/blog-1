<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('email/verify', 'Auth\VerificationController@verify')
    ->middleware('signed')
    ->name('email.verify');

Route::resource('/posts', 'PostController')->only(['index', 'show']);
