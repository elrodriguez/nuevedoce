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

Route::middleware(['auth:sanctum', 'verified'])->prefix('setting')->group(function () {
    Route::get('dashboard', 'SettingController@index')->name('setting_dashboard');
    Route::get('parameters', 'ParametersController@index')->name('parameters');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::group(['prefix' => 'company'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_empresas'])->get('list', 'SetCompanyController@index')->name('setting_company');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_empresas_nuevo'])->get('create', 'SetCompanyController@create')->name('setting_company_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_empresas_editar'])->get('edit/{id}', 'SetCompanyController@edit')->name('setting_company_edit');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_empresas_entorno_del_sistema'])->get('system_environment/{id}', 'SetCompanyController@systemEnvironment')->name('setting_company_system_environment');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios'])->get('list', 'UsersController@index')->name('setting_users');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_nuevo'])->get('create', 'UsersController@create')->name('setting_users_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_editar'])->get('edit/{id}', 'UsersController@edit')->name('setting_users_edit');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_roles'])->get('roles/{id}', 'UsersController@roles')->name('setting_users_roles');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_usuarios_actividades'])->get('activities/{id?}', 'UsersController@activities')->name('setting_users_activities');
        Route::get('search', 'UsersController@autocomplete')->name('setting_users_search');
    });
    Route::group(['prefix' => 'establishment'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_establecimientos'])->get('list', 'SetEstablishmentController@index')->name('setting_establishment');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_establecimientos_nuevo'])->get('create', 'SetEstablishmentController@create')->name('setting_establishment_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_establecimientos_editar'])->get('edit/{id}', 'SetEstablishmentController@edit')->name('setting_establishment_edit');
    });
    Route::group(['prefix' => 'modules'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos'])->get('list', 'ModulesController@index')->name('setting_modules');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_nuevo'])->get('create', 'ModulesController@create')->name('setting_modules_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_editar'])->get('edit/{id}', 'ModulesController@edit')->name('setting_modules_edit');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_modulos_eliminar'])->get('permissions/{id}', 'ModulesController@permissions')->name('setting_modules_permissions');
    });
    Route::group(['prefix' => 'roles'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles'])->get('list', 'RolesController@index')->name('setting_roles');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_roles_permisos'])->get('permissions/{id}', 'RolesController@permissions')->name('setting_roles_permissions');
    });
    Route::group(['prefix' => 'banks'], function () {
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_listado'])->get('list', 'BanksController@index')->name('setting_banks');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_nuevo'])->get('create', 'BanksController@create')->name('setting_banks_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_editar'])->get('edit/{id}', 'BanksController@edit')->name('setting_banks_edit');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_cuentas'])->get('accounts', 'BanksController@accounts')->name('setting_banks_accounts');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_cuentas'])->get('accounts/create', 'BanksController@accountsCreate')->name('setting_banks_accounts_create');
        Route::middleware(['middleware' => 'role_or_permission:configuraciones_bancos_cuentas'])->get('accounts/edit/{id}', 'BanksController@accountsEdit')->name('setting_banks_accounts_edit');
    });
});
