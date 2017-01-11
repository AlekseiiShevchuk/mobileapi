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


use Illuminate\Support\Facades\Auth;

Route::get('/user', function () {
    return Auth::user();
})->middleware('auth:api');


Route::get('/products', 'ProductsController@getAllProducts');
Route::get('/products/{product}', 'ProductsController@getById')->where('product', '[0-9]+');
Route::get('/categories/{categoryId}/products', 'ProductsController@getProductsByCategory')->where('categoryId', '[0-9]+');
Route::get('/products/new', 'ProductsController@getNewProducts');
Route::get('/products/top-sales', 'ProductsController@getTopSalesProducts');

Route::get('categories', 'ProductCategoryController@index');
Route::get('categories/{id}', 'ProductCategoryController@show')->where('id', '[0-9]+');

Route::post('/user/register','UserController@register');
Route::put('/user','UserController@update')->middleware('auth:api');