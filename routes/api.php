<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventcategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\MembershipsubscriptionController;
use App\Http\Controllers\Api\permissionController;
use App\Http\Controllers\Api\privilegeController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\roleController;
use App\Http\Controllers\Api\screenController;
use App\Models\Eventcategory;
use App\Models\Privilege;

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


});
Route::post('register','App\Http\Controllers\AuthController@register');
Route::post('login','App\Http\Controllers\AuthController@login');

