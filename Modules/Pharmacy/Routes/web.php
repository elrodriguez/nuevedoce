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

Route::middleware(['auth:sanctum', 'verified'])->prefix('pharmacy')->group(function() {
    Route::get('dashboard', 'PharmacyController@index')->name('pharmacy_dashboard');
    Route::get('products_search', 'ProductController@searchItems')->name('pharmacy_products_search');
    Route::get('search_customers','SalesController@searchCustomers')->name('pharmacy_customers_search');
    Route::group(['prefix' => 'administration'], function() {
        Route::group(['prefix' => 'products'], function() {
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related','ProductController@related')->name('pharmacy_administration_products_related');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related/create','ProductController@relatedCreate')->name('pharmacy_administration_products_related_create');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related/edit/{id}','ProductController@relatedEdit')->name('pharmacy_administration_products_related_edit');
        });
    });
    Route::group(['prefix' => 'sales'], function() {
        Route::middleware(['middleware' => 'role_or_permission:farmacia_ventas_nuevo'])->get('create','SalesController@create')->name('pharmacy_sales_create');
    });
});