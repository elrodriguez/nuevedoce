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
    Route::get('symptoms_search', 'DiseasesController@searchSymptoms')->name('pharmacy_symptoms_search');
    Route::get('diseases_search', 'DiseasesController@searchDiseases')->name('pharmacy_diseases_search');
    Route::group(['prefix' => 'administration'], function() {
        Route::group(['prefix' => 'diseases'], function() {
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_enfermedades'])->get('list','DiseasesController@index')->name('pharmacy_administration_diseases');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_enfermedades'])->get('create','DiseasesController@create')->name('pharmacy_administration_diseases_create');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_enfermedades'])->get('edit/{id}','DiseasesController@edit')->name('pharmacy_administration_diseases_edit');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_enfermedades'])->get('symptoms/{id}','DiseasesController@symptoms')->name('pharmacy_administration_diseases_symptoms');
        });
        Route::group(['prefix' => 'symptom'], function() {
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_sintomas'])->get('list','SymptomController@index')->name('pharmacy_administration_symptom');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_sintomas'])->get('create','SymptomController@create')->name('pharmacy_administration_symptom_create');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_sintomas'])->get('edit/{id}','SymptomController@edit')->name('pharmacy_administration_symptom_edit');
        });
        Route::group(['prefix' => 'medicines'], function() {
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_medicinas'])->get('list','MedicinesController@index')->name('pharmacy_administration_medicines');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_medicinas'])->get('create','MedicinesController@create')->name('pharmacy_administration_medicines_create');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_medicinas'])->get('edit/{id}','MedicinesController@edit')->name('pharmacy_administration_medicines_edit');
        });
        Route::group(['prefix' => 'products'], function() {
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related','ProductController@related')->name('pharmacy_administration_products_related');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related/create','ProductController@relatedCreate')->name('pharmacy_administration_products_related_create');
            Route::middleware(['middleware' => 'role_or_permission:farmacia_administracion_productos_relacionados'])->get('related/edit/{id}','ProductController@relatedEdit')->name('pharmacy_administration_products_related_edit');
        });
    });
    Route::group(['prefix' => 'sales'], function() {
        Route::middleware(['middleware' => 'role_or_permission:farmacia_ventas_nuevo'])->get('create','SalesController@create')->name('pharmacy_sales_create');
        Route::get('print/{external_id}/{format?}/{type?}', 'SalesController@toPrintInvoice');
    });
});