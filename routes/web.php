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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', function(){
    return view("home");
})->name('home');

//观点详情页面
Route::get("detail/{id}" , 'DetailController@index');
Route::post('comment' , 'DetailController@comment');
Route::get('comment/page' , 'DetailController@page');
Route::post("collect" , 'DetailController@collect');
Route::post("praise" , 'DetailController@praise');