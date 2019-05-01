<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');

Route::resource('/contact','Api\ContactController');

//put some data to get acess token
//by using passport
