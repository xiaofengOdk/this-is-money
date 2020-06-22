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
Route::prefix('/money')->group(function(){
		Route::any('index',"Index\IndexController@index");
});
Route::prefix('/admin')->group(function(){
		Route::any('/index',"Admin\AdminController@index");
		Route::any('/banner_do',"Admin\AdminController@banner_do");
});