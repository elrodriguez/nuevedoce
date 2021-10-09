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

Route::middleware(['auth:sanctum', 'verified'])->prefix('transferservice')->group(function() {
    Route::get('dashboard', 'TransferServiceController@index')->name('transferservice_dashboard');

    Route::group(['prefix' => 'customers'], function() {
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_clientes'])->get('list', 'CustomerController@index')->name('service_customers_index');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_clientes_nuevo'])->get('create/{id}', 'CustomerController@create')->name('service_customers_create');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_clientes_editar'])->get('edit/{id}', 'CustomerController@edit')->name('service_customers_edit');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_clientes_buscar'])->get('search', 'CustomerController@search')->name('service_customers_search');
    });

    Route::group(['prefix' => 'locals'], function() {
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_locales'])->get('list', 'LocalController@index')->name('service_locals_index');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_locales_nuevo'])->get('create', 'LocalController@create')->name('service_locals_create');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_locales_editar'])->get('edit/{id}', 'LocalController@edit')->name('service_locals_edit');
    });
});
