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

#Auth routes
Auth::routes();

#Frontend Routes
Route::group(['as' => 'frontend.', 'namespace' => 'FrontEnd'], function () {
    Route::get('/', 'HomeController@index');
});

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

        // Categories
        Route::get('categories/listing', 'CategoriesController@listing')->name('categories.listing');
        Route::resource('categories', 'CategoriesController');
        Route::get('categories/{category}/unassigned-attributes', 'CategoryUnassignedAttributesController@index')->name('categories.unassigned-attributes.index');
        Route::post('categories/{category}/attributes/{attribute}', 'CategoryAttributesController@store')->name('categories.attributes.store');
        Route::delete('categories/{category}/attributes/{attribute}', 'CategoryAttributesController@destroy')->name('categories.attributes.destroy');

        // Attributes
        Route::get('attributes/listing', 'AttributesController@listing')->name('attributes.listing');
        Route::resource('attributes', 'AttributesController');
        Route::get('attributes/{attribute}/options', 'AttributeOptionsController@index')->name('attributes.options.index');
        Route::post('attributes/{attribute}/options', 'AttributeOptionsController@store')->name('attributes.options.store');
        Route::put('attributes/{attribute}/options/{option}', 'AttributeOptionsController@update')->name('attributes.options.update');
    });
});