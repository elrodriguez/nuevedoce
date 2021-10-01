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

Route::middleware(['auth:sanctum', 'verified'])->prefix('personal')->group(function() {
    Route::get('dashboard', 'PersonalController@index')->name('personal_dashboard');

    Route::group(['prefix' => 'employees_type'], function() {
        Route::get('list', 'EmployeeTypeController@index')->name('personal_employee-type_index');
        Route::get('create', 'EmployeeTypeController@create')->name('personal_employee-type_create');
        Route::get('edit/{id}', 'EmployeeTypeController@edit')->name('personal_employee-type_edit');
    });

    Route::group(['prefix' => 'occupations'], function() {
        Route::get('list', 'OccupationController@index')->name('personal_occupation_index');
        Route::get('create', 'OccupationController@create')->name('personal_occupation_create');
        Route::get('edit/{id}', 'OccupationController@edit')->name('personal_occupation_edit');
    });

    Route::group(['prefix' => 'employees'], function() {
        Route::get('list', 'EmployeeController@index')->name('personal_employees_index');
        Route::get('create/{id}', 'EmployeeController@create')->name('personal_employees_create');
        Route::get('edit/{id}', 'EmployeeController@edit')->name('personal_employees_edit');
        Route::get('search', 'EmployeeController@search')->name('personal_employees_search');
    });
});

