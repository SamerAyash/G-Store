<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
//////////////////////////////////////////////////////////////////////////
Route::get('/login',['as'=>'login','uses'=>'HomeController@login']);
Route::post('/login','HomeController@dologin');
Route::get('/register',['as'=>'register','uses'=>'HomeController@register']);
Route::post('/register',['as'=>'register','uses'=>'HomeController@doRegister']);
Route::get('/logout', ['as'=>'logout','uses'=>'HomeController@logout']);
///////////////////////////////////////////////////////////////////////////
Route::get('/',['as'=>'home','uses'=>'HomeController@index']);
Route::get('/product/{id}',['as'=>'product','uses'=>'HomeController@getProduct']);
Route::middleware(['auth:web'])->group(function () {

    Route::get('/cart',['as'=>'cart','uses'=>'buyerController@cart']);
    Route::get('/order',['as'=>'order','uses'=>'buyerController@getOrders']);
    Route::post('addToCart/{id}','BuyerController@addToCart');
    Route::post('checkout','BuyerController@checkout');
    Route::delete('deleteFromCart/{id}','BuyerController@deleteFromCart');
    Route::delete('deleteOrder/{id}','BuyerController@deleteOrder');
});


Route::get('/index',function (){
    return view('welcome');
    })->name('index');
