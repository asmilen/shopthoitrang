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

Route::get('auth/google', 'Auth\AuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => 'admin', 'prefix' => 'quantri', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index');

    Route::group(['middleware' => 'acl'],function() {
        // Users
        Route::get('users/datatables', 'UsersController@getDatatables')->name('users.datatables');
        Route::resource('users', 'UsersController');
        Route::get('users/{user}/permissions', 'UserPermissionsController@index')->name('userPermissions.index');
        Route::put('users/{user}/permissions', 'UserPermissionsController@update')->name('userPermissions.update');

        // Roles
        Route::get('roles/datatables', 'RolesController@getDatatables')->name('roles.datatables');
        Route::resource('roles', 'RolesController');
        Route::get('roles/{role}/permissions', 'RolePermissionsController@index')->name('rolePermissions.index');
        Route::put('roles/{role}/permissions', 'RolePermissionsController@update')->name('rolePermissions.update');

        // Permissions
        Route::resource('permissions', 'PermissionsController', ['only' => ['index']]);
    });
});