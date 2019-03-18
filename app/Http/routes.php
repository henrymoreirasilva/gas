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

Route::get('admin/branches', 'BranchesController@index');
Route::get('admin/clients', 'ClientsController@index');
Route::get('admin/products', 'ProductsController@index');
Route::get('admin/sales', 'SalesController@index');
Route::get('admin/sellers', 'SellersController@index');