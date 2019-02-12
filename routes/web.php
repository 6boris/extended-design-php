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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("orders","OrderController");
//Route::resource("pays","PayController");

//  支付页面
Route::get("pays/{order_num}","PayController@pay");

//  支付回调
Route::any("pays/callback/{channel_code}","PayController@callback");



