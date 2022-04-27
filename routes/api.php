<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventcategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\MembershipsubscriptionController;
use App\Http\Controllers\Api\NotificationSubscriptionController;
use App\Http\Controllers\Api\permissionController;
use App\Http\Controllers\Api\privilegeController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\roleController;
use App\Http\Controllers\Api\screenController;
use App\Models\Eventcategory;
use App\Models\Privilege;

use App\Http\Controllers\MentorController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\TeamController;

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

    Route::get('workshop',[WorkshopController::class,'index']);
    Route::post('workshop',[WorkshopController::class,'store']);
    Route::get('workshop/{id}',[WorkshopController::class,'show']);
    Route::put('workshop/{id}',[WorkshopController::class,'update']);
    Route::delete('workshop/{id}',[WorkshopController::class,'destroy']);


    Route::get('mentor',[MentorController::class,'index']);
    Route::post('mentor',[MentorController::class,'store']);
    Route::get('mentor/{id}',[MentorController::class,'show']);
    Route::put('mentor/{id}',[MentorController::class,'update']);
    Route::delete('mentor/{id}',[MentorController::class,'destroy']);

    Route::get('gallery',[GalleryController::class,'index']);
    Route::post('gallery',[GalleryController::class,'store']);
    Route::get('gallery/{id}',[GalleryController::class,'show']);
    Route::put('gallery/{id}',[GalleryController::class,'update']);
    Route::delete('gallery/{id}',[GalleryController::class,'destroy']);

    Route::get('team',[TeamController::class,'index']);
    Route::post('team',[TeamController::class,'store']);
    Route::get('team/{id}',[TeamController::class,'show']);
    Route::put('team/{id}',[TeamController::class,'update']);
    Route::delete('team/{id}',[TeamController::class,'destroy']);

        // raksha
    Route::post('permission',[permissionController::class,'store']);
    Route::post('permission/{id}',[permissionController::class,'update']);
    Route::delete('permission/delete/{id}',[permissionController::class,'destroy']);
    // Route::apiResource('permission',[permissionController::class,]);

    Route::apiResource('privilege',privilegeController::class);
    Route::apiResource('role',roleController::class);
    Route::apiResource('screen',screenController::class);
    Route::apiResource('membership',MembershipController::class);
    Route::apiResource('membershipsubscription',MembershipsubscriptionController::class);
    Route::apiResource('rating',RatingController::class);
    Route::apiResource('event',EventController::class);
    Route::apiResource('eventcategory',EventcategoryController::class);
    Route::apiResource('notificationsubscription',NotificationSubscriptionController::class);

    Route::get('/mail','App\Http\Controllers\SmtpController@sendmailOTP');//sendOTP to user through email
    Route::post('/verifymailOTP','App\Http\Controllers\SmtpController@inputOTP');//verify sent OTP
    Route::get('useremailverification','App\Http\Controllers\SmtpController@verified');//only for email verification,user must be signed in.
    Route::post('otpverification','App\Http\Controllers\SmtpController@OTP');//send code to verify email
});
    Route::post('register','App\Http\Controllers\AuthController@register');
    Route::post('login','App\Http\Controllers\AuthController@login');

