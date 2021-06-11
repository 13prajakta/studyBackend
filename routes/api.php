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
Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@login');
// Route::get('checkdetails', 'RegisterController@checkdetails');
Route::post('university', 'UniversityController@createuniversity');
Route::get('universities', 'UniversityController@universities');
Route::post('getintouch', 'GetintouchController@getintouch');
Route::post('scholership', 'ScholershipController@scholership');
Route::get('scholershiplist', 'ScholershipController@scholershiplist');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('checkdetails', 'UserdetailController@checkdetails');
});