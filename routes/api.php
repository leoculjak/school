<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    // Route::get('user', 'UserController@index');
    // Route::get('user/current', 'UserController@getCurrent');
    // Route::get('user/{id}', 'UserController@show');

    Route::resource('class', 'ClassController', ['except' => ['create','edit']]);
    Route::resource('student', 'StudentController', ['except' => ['create','edit']]);
});


