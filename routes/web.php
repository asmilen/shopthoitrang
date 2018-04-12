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
    return view('welcometo');
});

Auth::routes();
#Admin Routes

Route::group(['middleware' => 'web'], function () {
    Route::get('/admin', 'Admin\DashboardController@index');

    Route::get('auth/google', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');

    Route::group(['middleware' => 'acl'],function() {

    });
});