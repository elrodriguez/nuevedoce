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

Route::middleware(['auth:sanctum', 'verified'])->prefix('lend')->group(function() {
    Route::get('dashboard', 'LendController@index')->name('lend_dashboard');

    Route::group(['prefix' => 'interest'], function() {
        Route::middleware(['middleware' => 'role_or_permission:prestamos_intereses'])->get('list', 'InterestsController@index')->name('lend_interest_list');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_intereses_nuevo'])->get('create', 'InterestsController@create')->name('lend_interest_create');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_intereses_editar'])->get('edit/{id}', 'InterestsController@edit')->name('lend_interest_edit');
    });

    Route::group(['prefix' => 'paymentmethod'], function() {
        Route::middleware(['middleware' => 'role_or_permission:prestamos_forma_pago'])->get('list', 'PaymentMethodController@index')->name('lend_paymentmethod_index');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_forma_pago_nuevo'])->get('create', 'PaymentMethodController@create')->name('lend_paymentmethod_create');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_forma_pago_editar'])->get('edit/{id}', 'PaymentMethodController@edit')->name('lend_paymentmethod_edit');
    });

    Route::group(['prefix' => 'quota'], function() {
        Route::middleware(['middleware' => 'role_or_permission:prestamos_cuotas'])->get('list', 'QuotaController@index')->name('lend_quota_index');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_cuotas_nuevo'])->get('create', 'QuotaController@create')->name('lend_quota_create');
        Route::middleware(['middleware' => 'role_or_permission:prestamos_cuotas_editar'])->get('edit/{id}', 'QuotaController@edit')->name('lend_quota_edit');
    });
});
