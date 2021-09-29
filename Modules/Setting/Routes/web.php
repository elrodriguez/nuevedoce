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
    Route::group(['prefix' => 'establishment'], function() {
        Route::get('list', 'SetEstablishmentController@index')->name('setting_establishment');
        Route::get('create', 'SetEstablishmentController@create')->name('setting_establishment_create');
        Route::get('edit/{id}', 'SetEstablishmentController@edit')->name('setting_establishment_edit');
    });
    Route::group(['prefix' => 'modules'], function() {
        Route::get('list', 'ModulesController@index')->name('setting_modules');
        Route::get('create', 'ModulesController@create')->name('setting_modules_create');
        Route::get('edit/{id}', 'ModulesController@edit')->name('setting_modules_edit');
        Route::get('permissions/{id}', 'ModulesController@permissions')->name('setting_modules_permissions');
    });
    Route::group(['prefix' => 'roles'], function() {
        Route::get('list', 'RolesController@index')->name('setting_roles');
        Route::get('permissions/{id}', 'RolesController@permissions')->name('setting_roles_permissions');
    });
});
