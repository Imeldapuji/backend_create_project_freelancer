<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('create', "ProjectController@store");
Route::get('project', "ProjectController@getAll");
