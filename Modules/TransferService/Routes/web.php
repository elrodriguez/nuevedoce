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

    Route::group(['prefix' => 'vehicles'], function() {
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_vehiculos'])->get('list', 'VehicleController@index')->name('service_vehicles_index');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_vehiculos_nuevo'])->get('create', 'VehicleController@create')->name('service_vehicles_create');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_vehiculos_editar'])->get('edit/{id}', 'VehicleController@edit')->name('service_vehicles_edit');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_vehiculos_tripulacion'])->get('crew/{id}', 'VehicleController@crew')->name('service_vehicles_crew');
        Route::get('search_employee', 'VehicleController@searchEmployee')->name('service_vehicles_search_employee');
    });

    Route::group(['prefix' => 'odt_requests'], function() {
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_solicitudes_odt'])->get('list', 'OdtRequestController@index')->name('service_odt_requests_index');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_solicitudes_odt_nuevo'])->get('create', 'OdtRequestController@create')->name('service_odt_requests_create');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_solicitudes_odt_editar'])->get('edit/{id}', 'OdtRequestController@edit')->name('service_odt_requests_edit');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_solicitudes_odt_nuevo_programacion'])->get('programming', 'OdtRequestController@programming')->name('service_odt_requests_programming');
        Route::get('search', 'OdtRequestController@autocomplete')->name('service_odt_requests_search');
        Route::get('search_item', 'OdtRequestController@autocompleteItems')->name('service_odt_items_search');
    });

    Route::group(['prefix' => 'load_order'], function() {
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_orden_carga'])->get('list', 'LoadOrderController@index')->name('service_load_order_index');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_orden_carga_nuevo'])->get('create', 'LoadOrderController@create')->name('service_load_order_create');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_orden_carga_editar'])->get('edit/{id}', 'LoadOrderController@edit')->name('service_load_order_edit');
        Route::middleware(['middleware' => 'role_or_permission:serviciodetraslados_orden_carga'])->get('print/{id}', 'LoadOrderController@print')->name('service_load_order_pdf');
    });
});
