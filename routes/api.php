<?php

// Auth
Route::post('/register', 'Auth\AuthController@register');
Route::post('/login', 'Auth\AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', 'Auth\AuthController@logout');
    Route::get('/me', 'Auth\AuthController@user');
});

// Auth Protected routes
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/posts', 'Posts\PostsController');
});
