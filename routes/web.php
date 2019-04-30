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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','IndexController@index');
Route::get('/stubase','IndexController@stubase');
Route::get('/stubase1','IndexController@stubase1');
Route::get('/stubase2','IndexController@stubase2');
Route::get('/stubase3','IndexController@stubase3');
Route::get('/stubase4','IndexController@stubase4');
Route::get('/stubase5','IndexController@stubase5');
Route::get('/teacherbase','IndexController@teacherbase');
Route::get('/teacherbase1','IndexController@teacherbase1');
Route::get('/teacherbase2','IndexController@teacherbase2');
Route::get('/teacherbase3','IndexController@teacherbase3');
Route::get('/teacherbase4','IndexController@teacherbase4');
Route::get('/stufee','IndexController@stufee');
Route::get('/stufee1','IndexController@stufee1');
Route::get('/stufee2','IndexController@stufee2');
Route::get('/stufee3','IndexController@stufee3');
Route::get('/stufee4','IndexController@stufee4');
Route::get('/zcbase','IndexController@zcbase');
Route::get('/zcbase1','IndexController@zcbase1');
Route::get('/zcbase2','IndexController@zcbase2');
Route::get('/zcbase3','IndexController@zcbase3');
Route::get('/zcbase4','IndexController@zcbase4');
Route::get('/doombase','IndexController@doombase');
Route::get('/doombase1','IndexController@doombase1');
Route::get('/doombase2','IndexController@doombase2');
Route::get('/doombase3','IndexController@doombase3');
Route::get('/tsgbase','IndexController@tsgbase');
Route::get('/tsgbase1','IndexController@tsgbase1');
Route::get('/tsgbase2','IndexController@tsgbase2');
Route::get('/tsgbase3','IndexController@tsgbase3');
Route::get('/ykt','IndexController@ykt');
Route::get('/kq','IndexController@kq');
Route::get('/teach','IndexController@teach');
Route::get('/getsemester','IndexController@getsemester');
Route::get('/msg','IndexController@msg');
Route::get('/set','IndexController@set');
Route::get('/changeskin','IndexController@changeskin');