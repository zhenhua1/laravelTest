<?php

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

//需要登录才能访问的控制器
Route::group(['namespace'=>'Api','middleware'=>'auth:api'],function (){

});
//auth控制器
Route::group(['namespace'=>'Api','prefix' => 'auth'],function(){
    require_once base_path('routes/api/auth.php');
});
//首页
Route::get('home','Api\MainController@index')->name('home');

