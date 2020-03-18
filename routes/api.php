<?php

use App\User;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/buyers','UserController@getBuyers');
    Route::delete('/buyers/{id}','UserController@destroy');
    Route::patch('/buyers/{id}','UserController@updateBuyer');
    /////////////////////////////////////////////////////////////////
    Route::get('/sellers','UserController@getSellers');
    Route::patch('/sellers/{id}','UserController@updateSeller');
    Route::delete('/sellers/{id}','UserController@destroy');
    /////////////////////////////////////////////////////////////////
    Route::get('/supervisors','AdminController@getSupervisors');
    Route::post('/supervisors','AdminController@storeSupervisor');
    Route::patch('/supervisors/{id}','AdminController@updateSupervisor');
    Route::delete('/supervisors/{id}','AdminController@destroy');
    /////////////////////////////////////////////////////////////////
    Route::get('/delivery','AdminController@getDelivery');
    Route::post('/delivery','AdminController@storeDelivery');
    Route::patch('/delivery/{id}','AdminController@updateDelivery');
    Route::delete('/delivery/{id}','AdminController@destroy');
    /// ////////////////////////////////////////////////////////////
    Route::post('/searchBuyer','UserController@searchBuyer');
});

