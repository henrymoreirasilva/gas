<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('acesso-negado', function () {
    return view('acesso-negado');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole:admin,user', 'as' => 'admin.'], function() {
    Route::group(['prefix' => 'users', 'middleware' => 'auth.checkrole:admin', 'as' => 'users.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'UsersController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'UsersController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'UsersController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'UsersController@store']);
    });
    
    Route::group(['prefix' => 'branches', 'as' => 'branches.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'BranchesController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'BranchesController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'BranchesController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'BranchesController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'BranchesController@store']);
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'ClientsController@store']);
    });
    
        Route::group(['prefix' => 'sellers', 'as' => 'sellers.'], function() {
            Route::get('/', ['as' => 'index', 'uses' => 'SellersController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'SellersController@create']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SellersController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'SellersController@update']);
            Route::post('store', ['as' => 'store', 'uses' => 'SellersController@store']);
        });
});

Route::get('admin/products', 'ProductsController@index');
Route::get('admin/sales', 'SalesController@index');