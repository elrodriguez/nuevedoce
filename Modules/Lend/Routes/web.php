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
        Route::middleware(['middleware' => 'role_or_permission:prestamos_intereses'])->get('list', 'InterestsController@index')->name('lend_interests_list');
    });
});
