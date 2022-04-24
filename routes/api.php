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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/workshop',function(){
        return 'this is a unauth path';
    });
    Route::post('logout','App\Http\Controllers\AuthController@logout');

    Route::get('workshop','App\Http\Controllers\WorkshopController@index');   
    Route::post('workshop','App\Http\Controllers\WorkshopController@store');   
    Route::get('workshop/{id}','App\Http\Controllers\WorkshopController@show');   
    Route::put('workshop/{id}','App\Http\Controllers\WorkshopController@update'); 
    Route::delete('workshop/{id}','App\Http\Controllers\WorkshopController@destroy');       

    Route::get('/mail','App\Http\Controllers\SmtpController@sendmailOTP');//sendOTP to user through email
    Route::post('/verifymailOTP','App\Http\Controllers\SmtpController@inputOTP');
    Route::get('useremailverification','App\Http\Controllers\SmtpController@verified');//only for email verification,user must be signed in.
    Route::post('otpverification','App\Http\Controllers\SmtpController@OTP');//send code to verify email
});
Route::post('register','App\Http\Controllers\AuthController@register');
Route::post('login','App\Http\Controllers\AuthController@login');

