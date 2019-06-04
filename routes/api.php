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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function(){
    Route::any('class','IndexController@bclass');
    Route::any('index','IndexController@index');
    Route::any('teacherbd','IndexController@teacherbd');
    Route::any('parentbd','IndexController@parentbd');
    Route::any('account','IndexController@account');
    Route::any('unbd','IndexController@unbd');
    Route::any('notice','IndexController@notice');
    Route::any('subject','IndexController@subject');
    Route::any('getTeacherBysub','IndexController@getTeacherBysub');
    Route::any('teachdetail','IndexController@teachdetail');
    Route::any('chargeproject','IndexController@chargeproject');
    Route::any('chargestardard','IndexController@chargestardard');
});  //路由路径Controllers/Api/IndexController/index
