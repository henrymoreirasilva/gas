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
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'BranchesController@show']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'BranchesController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'BranchesController@store']);
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'ClientsController@show']);
        Route::get('show/{id}/{branchId}', ['as' => 'show', 'uses' => 'ClientsController@show']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'ClientsController@store']);
        
        Route::get('get-clients/{expression}', ['as' => 'get-clients', 'uses' => 'ClientsController@listsNameWith']);
    });
    
    Route::group(['prefix' => 'sellers', 'as' => 'sellers.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'SellersController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'SellersController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SellersController@edit']);
        Route::get('show/{id}/{branchId}', ['as' => 'show', 'uses' => 'SellersController@show']);
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'SellersController@show']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'SellersController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'SellersController@store']);
    });
    
    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('get/{id}', ['as' => 'get', 'uses' => 'ProductsController@get']);
        
        Route::get('getproducts/{expression}', ['as' => 'getproducts', 'uses' => 'ProductsController@getProducts']);
    });
    
    Route::group(['prefix' => 'sales', 'as' => 'sales.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'SalesController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'SalesController@create']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SalesController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'SalesController@update']);
        Route::post('store', ['as' => 'store', 'uses' => 'SalesController@store']);
    });
});
