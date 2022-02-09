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

Route::middleware(['auth:sanctum', 'verified'])->prefix('sales')->group(function() {
    Route::get('dashboard', 'SalesController@index')->name('sales_dashboard');

    Route::group(['prefix' => 'administration'], function() {
        Route::middleware(['middleware' => 'role_or_permission:ventas_administracion_caja_chica'])->get('cash','CashController@index')->name('sales_administration_cash');
    
        Route::middleware(['middleware' => 'role_or_permission:ventas_administracion_caja_chica_cerrar'])->get('cash/delete/{id}','CashController@closeCash')->name('sales_administration_cash_close');
        Route::get('cash/report/{id}','CashController@report')->name('sales_administration_cash_report_pdf');
        Route::get('cash/report_products/{id}', 'CashController@report_products')->name('sales_administration_cash_report_products_pdf');
        Route::get('cash/report_products_excel/{id}', 'CashController@report_products_excel')->name('sales_administration_cash_reportproducts_excel_pdf');
    });
});
