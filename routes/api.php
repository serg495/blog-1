<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Admin\Api', 'prefix' => 'admin'], function () {
    Route::get('posts', 'PostController@index');
    Route::get('posts/{post}/show', 'PostController@index');
    Route::post('posts/store', 'PostController@store');
    Route::post('posts/{post}/update', 'PostController@update');
    Route::delete('posts/{post}/delete', 'PostController@destroy');
});
