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

Route::middleware(['auth:sanctum', 'verified'])->prefix('inventory')->group(function() {
    Route::get('dashboard', 'InventoryController@index')->name('inventory_dashboard');
   
    Route::group(['prefix' => 'category'], function() {
        Route::middleware(['middleware' => 'role_or_permission:inventario_categorias'])->get('list', 'CategoryController@index')->name('inventory_category');
        Route::middleware(['middleware' => 'role_or_permission:inventario_categorias_nuevo'])->get('create', 'CategoryController@create')->name('inventory_category_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_categorias_editar'])->get('edit/{id}', 'CategoryController@edit')->name('inventory_category_edit');
    });

    Route::group(['prefix' => 'brand'], function() {
        Route::middleware(['middleware' => 'role_or_permission:inventario_marcas'])->get('list', 'BrandController@index')->name('inventory_brand');
        Route::middleware(['middleware' => 'role_or_permission:inventario_marcas_nuevo'])->get('create', 'BrandController@create')->name('inventory_brand_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_marcas_editar'])->get('edit/{id}', 'BrandController@edit')->name('inventory_brand_edit');
    });

    Route::group(['prefix' => 'asset'], function() {
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos'])->get('list', 'AssetController@index')->name('inventory_asset');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_nuevo'])->get('create', 'AssetController@create')->name('inventory_asset_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_editar'])->get('edit/{id}', 'AssetController@edit')->name('inventory_asset_edit');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos'])->get('part_list/{id_asset}', 'AssetPartController@index')->name('inventory_asset_part');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_nuevo'])->get('part_create', 'AssetPartController@create')->name('inventory_asset_part_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_editar'])->get('part_edit/{id}', 'AssetPartController@edit')->name('inventory_asset_part_edit');
    });
    
});
