<?php

use Illuminate\Http\Request;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::group(['middleware' => ['jwt.verify']], function ()
{
Route::group(['middleware' => ['api.superadmin']], function ()
{
  Route::delete('/customers/{id}', 'CustomersController@destroy');
  Route::delete('product','productController@destroy');
  Route::delete('/orders','ordersController@destroy');
});

Route::group(['middleware' => ['api.admin']], function ()
{
  Route::post('/customers', 'customersController@store');
  Route::put('/customers/{id}', 'customersController@update');

  Route::post('/product', 'productController@store');
  Route::put('/product/{id}', 'productController@update');

  Route::post('/orders', 'ordersController@store');
  Route::put('/orders/{id}', 'ordersController@update');
)};
Route::get('/customers', 'customersController@show');
Route::get('/customers/{id}', 'customersController@detail');

Route::get('/product', 'productController@show');
Route::get('/product/{id}', 'productController@detail');

Route::get('/orders', 'ordersController@show');
Route::get('/orders/{id}', 'ordersController@detail');
)};
