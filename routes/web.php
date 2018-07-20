<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('email/verify', 'Auth\VerificationController@verify')
    ->middleware('signed')
    ->name('email.verify');

Route::get('/home', 'HomeController@index')->name('home');
