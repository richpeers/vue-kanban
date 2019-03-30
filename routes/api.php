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

    // Boards
    Route::resource('/boards', 'Boards\BoardController')->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    // Cards
    Route::resource('/cards', 'Cards\CardController')->only([
        'store', 'show', 'update', 'destroy'
    ]);

    // Columns
    Route::post('/columns/update-order', 'Columns\UpdateColumnOrderController');
    Route::resource('/columns', 'Columns\ColumnController')->only([
        'store', 'show', 'update', 'destroy'
    ]);

    // Comments
    Route::resource('/comments', 'Comments\CommentController')->only([
        'store', 'show', 'update', 'destroy'
    ]);

    // Teams
    Route::resource('/teams', 'Teams\TeamController')->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});
