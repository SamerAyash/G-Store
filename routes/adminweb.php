<?php
use \Illuminate\Support\Facades\Config;
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Config::set('auth.defines','admin');
    ///////////////////////////////////////////////////////////
        Route::get('/login',['as'=>'admin.login','uses'=>'AdminAuth@login']);
        Route::post('/login',['as'=>'admin.dologin','uses'=>'AdminAuth@dologin']);
        Route::get('/forgot/password',['as'=>'admin.forgotPassword','uses'=>'AdminAuth@forgetPassword']);
        Route::post('/forgot/password',['as'=>'admin.resetPassword','uses'=>'AdminAuth@resetPassword']);
        Route::get('/reset/password/{token}',['as'=>'admin.resetPasswordToken','uses'=>'AdminAuth@resetPasswordWithToken']);
        Route::post('/update/{token}',['as'=>'admin.updatePassword','uses'=>'AdminAuth@updatePassword']);
    ///////////////////////////////////////////////////////////
    Route::group(['middleware'=>'admin:admin'],function (){
        /// First admin word means middleware class and second admin word means guard type
        Route::get('/',[
            'as'=>'admin.acountsTable',
            'uses'=>'AdminController@index',
            'role'=>['superAdmin','supervisor'],
            'permission'=>''
        ]);
        Route::get('/logout',['as'=>'admin.logout','uses'=>'AdminAuth@logout']);
        Route::get('/home',[
            'as'=>'admin.home',
            'middleware'=>'adminPermission',
            'uses'=>'AdminAuth@index',
            'role'=>['superAdmin','supervisor'],
            'permission'=>''
        ]);
    });


});
