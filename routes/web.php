<?php

/*
  |--------------------------------------------------------------------------
  | 首页
  |--------------------------------------------------------------------------
  */
Route::get('/', 'IndexController@index');

/*
  |--------------------------------------------------------------------------
  | 登录注册
  |--------------------------------------------------------------------------
  */
Auth::routes();

/*
  |--------------------------------------------------------------------------
  |
  |--------------------------------------------------------------------------
  */
Route::get('/home', function(){
    return view("home");
})->name('home');

/*
  |--------------------------------------------------------------------------
  | 观点详情页面
  |--------------------------------------------------------------------------
  */
Route::get("detail/{id}" , 'DetailController@index');
Route::post('comment' , 'DetailController@comment');
Route::get('comment/page' , 'DetailController@page');
Route::post("collect" , 'DetailController@collect');
Route::post("praise" , 'DetailController@praise');

/*
  |--------------------------------------------------------------------------
  | 用户中心
  |--------------------------------------------------------------------------
  */
Route::any("user/index" , 'UserController@index');
Route::any("user/basicProfile" , 'UserController@basicProfile');
Route::any("user/city" , 'UserController@city');
Route::post("user/uploadify" , 'UserController@uploadify');