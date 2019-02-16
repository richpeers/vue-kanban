<?php

/**
 * Auth
 */
Route::post('/register', 'Auth\AuthController@register');
Route::post('/login', 'Auth\AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', 'Auth\AuthController@logout');
    Route::get('/user', 'Auth\AuthController@user');
});

Route::group(['middleware' => 'jwt.auth'], function () {

}