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

Route::middleware(['auth:sanctum', 'verified'])->prefix('setting')->group(function() {
    Route::get('dashboard', 'SettingController@index')->name('setting_dashboard');

    Route::group(['prefix' => 'company'], function() {
        Route::get('data', 'SetCompanyController@index')->name('setting_company');
    });
    Route::group(['prefix' => 'users'], function() {
        Route::get('list', 'UsersController@index')->name('setting_users');
        Route::get('create', 'UsersController@create')->name('setting_users_create');
        Route::get('edit/{id}', 'UsersController@edit')->name('setting_users_edit');
    });
    
});
