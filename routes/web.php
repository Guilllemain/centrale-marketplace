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

Route::get('/', 'HomeController@index')->name('home');

// Route::get('/search', 'CategoriesController@search');

Route::get('/search', 'Api\SearchController@index');

Route::get('/product/{id}', 'ProductsController@show')->name('test.show');

Route::get('/basket/add', 'BasketController@addProduct');
Route::get('/basket', 'BasketController@index');

Route::get('company/{company}', 'CompaniesController@show');

Route::get('/{category}/{subCategory?}/{finalCategory?}', 'CategoriesController@show')->name('category.show');
Route::get('/{category}/{subCategory}/{finalCategory}/{slug}', 'ProductsController@show')->name('product.show');
