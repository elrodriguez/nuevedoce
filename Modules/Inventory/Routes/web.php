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

    Route::group(['prefix' => 'item'], function() {
        Route::middleware(['middleware' => 'role_or_permission:inventario_items'])->get('list', 'ItemController@index')->name('inventory_item');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_nuevo'])->get('create', 'ItemController@create')->name('inventory_item_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_editar'])->get('edit/{id}', 'ItemController@edit')->name('inventory_item_edit');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_fotos'])->get('file/{item_id}', 'ItemFileController@edit')->name('inventory_item_file');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_fotos'])->post('/part_file', 'ItemFileController@dropZone')->name('inventory_item_upload_file');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_parte'])->get('part_list/{item_id}', 'ItemPartController@index')->name('inventory_item_part');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_parte_nuevo'])->get('part_create/{item_id}', 'ItemPartController@create')->name('inventory_item_part_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_items_parte_editar'])->get('part_edit/{id}', 'ItemPartController@edit')->name('inventory_item_part_edit');
        Route::get('search', 'ItemController@autocomplete')->name('inventory_item_search');
    });

    Route::group(['prefix' => 'asset'], function() {
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos'])->get('list', 'AssetController@index')->name('inventory_asset');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_nuevo'])->get('create', 'AssetController@create')->name('inventory_asset_create');
        Route::middleware(['middleware' => 'role_or_permission:inventario_activos_editar'])->get('edit/{id}', 'AssetController@edit')->name('inventory_asset_edit');
        Route::get('search', 'AssetController@autocomplete')->name('inventory_asset_search');
    });

});
