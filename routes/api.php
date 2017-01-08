<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/user', function () {
    return Auth::user();
})->middleware('auth:api');


Route::get('/products', 'ProductsController@getAllProducts');
Route::get('/category/{categoryId}/products', 'ProductsController@getProductsByCategory');
Route::get('/products/new', 'ProductsController@getNewProducts');