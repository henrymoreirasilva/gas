<?php

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

Route::get('admin/branches', ['as' => 'admin.branches.index', 'uses' => 'BranchesController@index']);
Route::get('admin/branches/create', ['as' => 'admin.branches.create', 'uses' => 'BranchesController@create']);
Route::post('admin/branches/store', ['as' => 'admin.branches.store', 'uses' => 'BranchesController@store']);
Route::get('admin/clients', 'ClientsController@index');
Route::get('admin/products', 'ProductsController@index');
Route::get('admin/sales', 'SalesController@index');
Route::get('admin/sellers', 'SellersController@index');