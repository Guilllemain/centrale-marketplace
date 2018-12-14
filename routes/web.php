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

Route::get('/', 'HomeController@index');

// Route::get('/search', 'CategoriesController@search');

Route::get('/search', 'Api\SearchController@index');

Route::get('/product/{category?}/{id}', 'ProductsController@show');

Route::get('/basket/add', 'BasketController@addProduct');
Route::get('/basket', 'BasketController@index');

Route::get('company/{company}', 'CompaniesController@show');

Route::get('/{category}', 'CategoriesController@show');
