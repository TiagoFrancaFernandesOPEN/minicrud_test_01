<?php

// use App\Http\Middleware\AuthuserMiddleware;
use Illuminate\Http\Request;

Route::group(['middleware'=>'authuser'], function(){
    Route::get('/', 'UserController@index')->name('site.home');
    Route::get('/users', 'UserController@index')->name('users.list');
});

//Login and auth
Route::get('/login', 'UserController@loginForm')->name('login.form');
Route::post('/login', 'UserController@loginPost')->name('login.post');
Route::get('/logout', 'UserController@logout')->name('auth.logout');

//Pages
Route::get('/denied', 'PageController@deniedPage')->name('denied.page');
Route::get('/confirm', 'PageController@defaultPage')->name('confirm.page');
