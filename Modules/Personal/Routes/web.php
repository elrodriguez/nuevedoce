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
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados'])->get('list', 'EmployeeTypeController@index')->name('personal_employee-type_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados_nuevo'])->get('create', 'EmployeeTypeController@create')->name('personal_employee-type_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados_editar'])->get('edit/{id}', 'EmployeeTypeController@edit')->name('personal_employee-type_edit');
    });

    Route::group(['prefix' => 'occupations'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones'])->get('list', 'OccupationController@index')->name('personal_occupation_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones_nuevo'])->get('create', 'OccupationController@create')->name('personal_occupation_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones_editar'])->get('edit/{id}', 'OccupationController@edit')->name('personal_occupation_edit');
    });

    Route::group(['prefix' => 'employees'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados'])->get('list', 'EmployeeController@index')->name('personal_employees_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_nuevo'])->get('create/{id}', 'EmployeeController@create')->name('personal_employees_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_editar'])->get('edit/{id}', 'EmployeeController@edit')->name('personal_employees_edit');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_buscar'])->get('search', 'EmployeeController@search')->name('personal_employees_search');
    });
});

