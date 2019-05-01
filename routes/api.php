<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');


//put some data to get acess token
//by using passport
