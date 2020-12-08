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

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    /** Formulario de Login */
    Route::get('/', 'AuthController@showLoginForm' )->name('login');
    Route::post('login', 'AuthController@login' )->name('login.do');

    /** Rotas Protegidas*/
    Route::group(['middleware' => ['auth']], function(){

        /** Deshboard Home */
        Route::get('home', 'AuthController@home' )->name('home');

        /** Usuarios */
        Route::resource('users', 'UserController');

        /** Clientes */
        Route::resource('customers', 'CustomerController');

        /** Proprietarios */
        Route::resource('owners', 'OwnerController');

        /** Imoveis */
        Route::resource('properties', 'PropertyController');

        /** Contratos */
        Route::post('contracts/get-data-owner', 'ContractController@getDataOwner')->name('contracts.getDataOwner');
        Route::post('contracts/get-data-property',
            'ContractController@getDataProperty')->name('contracts.getDataProperty');
        Route::resource('contracts', 'ContractController');
    });


    /** Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');
});
