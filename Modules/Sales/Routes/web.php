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

use Modules\Sales\Entities\SalCash;

Route::middleware(['auth:sanctum', 'verified'])->prefix('sales')->group(function() {
    Route::get('dashboard', 'SalesController@index')->name('sales_dashboard');

    Route::group(['prefix' => 'administration'], function() {
        Route::middleware(['middleware' => 'role_or_permission:ventas_administracion_caja_chica'])->get('cash','CashController@index')->name('sales_administration_cash');
    
        Route::middleware(['middleware' => 'role_or_permission:ventas_administracion_caja_chica_cerrar'])->get('cash/close/{id}','CashController@closeCash')->name('sales_administration_cash_close');
        Route::get('cash/report/{id}','CashController@report')->name('sales_administration_cash_report_pdf');
        Route::get('cash/report_products/{id}', 'CashController@report_products')->name('sales_administration_cash_report_products_pdf');
        Route::get('cash/report_products_excel/{id}', 'CashController@report_products_excel')->name('sales_administration_cash_reportproducts_excel_pdf');

        Route::middleware(['middleware' => 'role_or_permission:ventas_administration_series'])->get('series','SeriesController@index')->name('sales_administration_series');
        Route::middleware(['middleware' => 'role_or_permission:ventas_administration_series_nuevo'])->get('series/create','SeriesController@create')->name('sales_administration_series_create');
        Route::middleware(['middleware' => 'role_or_permission:ventas_administration_series_editar'])->get('series/edit/{id}','SeriesController@edit')->name('sales_administration_serie_edit');
    });

    Route::group(['prefix' => 'documents'], function(){
        Route::middleware(['middleware' => 'role_or_permission:ventas_comprobante_nuevo'])->get('documents_create', function () {
            $exists = SalCash::where('user_id',auth()->user()->id)->where('state',true)->first();
            if($exists){
                return view('sales::document.create');
            }else{
                return redirect()->route('sales_administration_cash');
            }
        })->name('sales_document_create');
        
        Route::get('products_search', 'ItemsController@searchItems')->name('sales_products_search');
        
        Route::middleware(['middleware' => 'role_or_permission:ventas_comprobantes_listado'])->get('documents_list', function () {
            return view('sales.sales.document_list');
        })->name('sales_document_list');

        Route::middleware(['middleware' => 'role_or_permission:ventas_documentos_nota'])->get('note/{id}', function ($id) {
            return view('sales.sales.note')->with('external_id',$id);
        })->name('sales_notes');

        Route::get('sale/search_customers','CustomersController@searchCustomers')->name('sales_customers_search');

        Route::get('print/{external_id}/{format?}', 'DocumentsController@toPrintInvoice');
    
        Route::middleware(['middleware' => 'role_or_permission:ventas_nota_venta'])->get('notes', 'SaleNotesController@index')->name('sales_documents_sale_notes');
        Route::middleware(['middleware' => 'role_or_permission:ventas_nota_venta_nuevo'])->get('notes/create', 'SaleNotesController@create')->name('sales_documents_sale_notes_create');
    
    });

});
