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
Route::get('/teacherbase','IndexController@teacherbase');
Route::get('/teacherfee','IndexController@teacherfee');
Route::get('/zcbase','IndexController@zcbase');
Route::get('/doombase','IndexController@doombase');
Route::get('/tsgbase','IndexController@tsgbase');
Route::get('/ykt','IndexController@ykt');
Route::get('/kq','IndexController@kq');
Route::get('/teach','IndexController@teach');
Route::get('/msg','IndexController@msg');
Route::get('/set','IndexController@set');