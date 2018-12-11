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

Auth::routes();

Route::get('/', 'CategoriesController@index');
Route::get('/search', 'CategoriesController@search');

Route::get('/product/{id}', 'ProductsController@show');

Route::get('/basket/add', 'BasketController@addProduct');
Route::get('/basket', 'BasketController@index');
