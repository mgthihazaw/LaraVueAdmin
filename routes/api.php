<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/user','api\UserController');
Route::get('/profile','api\UserController@profile');
Route::put('/profile','api\UserController@updateProfile');