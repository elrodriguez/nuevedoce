<?php

Route::middleware(['auth:sanctum', 'verified'])->prefix('staff')->group(function() {
    Route::get('dashboard', 'StaffController@index')->name('staff_dashboard');

    Route::group(['prefix' => 'employees_type'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados'])->get('list', 'EmployeeTypeController@index')->name('staff_employee-type_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados_nuevo'])->get('create', 'EmployeeTypeController@create')->name('staff_employee-type_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_tipo_empleados_editar'])->get('edit/{id}', 'EmployeeTypeController@edit')->name('staff_employee-type_edit');
    });

    Route::group(['prefix' => 'occupations'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones'])->get('list', 'OccupationController@index')->name('staff_occupation_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones_nuevo'])->get('create', 'OccupationController@create')->name('staff_occupation_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_ocupaciones_editar'])->get('edit/{id}', 'OccupationController@edit')->name('staff_occupation_edit');
    });

    Route::group(['prefix' => 'employees'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados'])->get('list', 'EmployeeController@index')->name('staff_employees_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_nuevo'])->get('create/{id}', 'EmployeeController@create')->name('staff_employees_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_editar'])->get('edit/{id}', 'EmployeeController@edit')->name('staff_employees_edit');
        Route::middleware(['middleware' => 'role_or_permission:personal_empleados_buscar'])->get('search', 'EmployeeController@search')->name('staff_employees_search');
    });

    Route::group(['prefix' => 'companies'], function() {
        Route::middleware(['middleware' => 'role_or_permission:personal_empresas'])->get('list', 'CompanyController@index')->name('staff_companies_index');
        Route::middleware(['middleware' => 'role_or_permission:personal_empresas_nuevo'])->get('create/{id}', 'CompanyController@create')->name('staff_companies_create');
        Route::middleware(['middleware' => 'role_or_permission:personal_empresas_editar'])->get('edit/{id}', 'CompanyController@edit')->name('staff_companies_edit');
        Route::middleware(['middleware' => 'role_or_permission:personal_empresas_buscar'])->get('search', 'CompanyController@search')->name('staff_companies_search');
    });
});

