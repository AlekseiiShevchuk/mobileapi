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
////////// Products
Route::get('/products', 'ProductsController@getAllProducts');
Route::get('/products/{product}', 'ProductsController@getById')->where('product', '[0-9]+');
Route::get('/categories/{categoryId}/products', 'ProductsController@getProductsByCategory')->where('categoryId', '[0-9]+');
Route::get('/products/new', 'ProductsController@getNewProducts');
Route::get('/products/top-sales', 'ProductsController@getTopSalesProducts');
Route::get('/products/special-offers', 'ProductsController@getSpecialOffers');

////////// Category
Route::get('categories', 'CategoryController@home');
Route::get('categories/{category}', 'CategoryController@getById')->where('category', '[0-9]+');

////////// User
Route::get('/user', function () {
    return Auth::user();
})->middleware(['auth:api']);
Route::post('/user/register','UserController@register');
Route::put('/user','UserController@update')->middleware(['auth:api']);
//Route::get('/guest', 'UserController@guest');
////////// Category
Route::get('/address/countries', 'AddressController@getCountriesList');
Route::get('/address/countries/{country}/states', 'AddressController@getStateList')->where('country', '[0-9]+');
Route::get('/addresses', 'AddressController@getUserAddresses')->middleware('auth:api');
Route::post('/addresses', 'AddressController@store')->middleware('auth:api');
Route::put('/addresses/{address}', 'AddressController@update')->middleware('auth:api');
Route::delete('/addresses/{address}', 'AddressController@destroy')->middleware('auth:api');
////// Carrier
Route::get('/carrier/zone/{zoneId}','CarrierController@getByZone')->where('zoneId','[0-9]+');
////// Cart
Route::get('/cart','CartController@get')->middleware('auth:api');
Route::put('/cart','CartController@update')->middleware('auth:api');
Route::post('/cart/product/{product}','CartController@addProduct')->middleware('auth:api')->where('product','[0-9]+');
Route::delete('/cart/product/{product}','CartController@removeProduct')->middleware('auth:api')->where('product','[0-9]+');
Route::get('/cart/redirect','CartController@redirectUrlOrder');
////// Test
//Route::get('/test/user','TestController@test');
Route::get('/test/conf','TestController@conf');