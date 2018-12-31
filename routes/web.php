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
// Route::post('/authenticate', 'Auth\LoginController@authenticate');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/search', 'Api\SearchController@index');

Route::get('/product/{id}', 'ProductsController@show')->name('test.show');

Route::get('/basket/add', 'BasketController@addProduct');
Route::get('/basket', 'BasketController@index');
Route::get('/basket/address', 'BasketController@updateAddress');
Route::post('/basket/update/{id}', 'BasketController@updateQuantity')->name('basket.update-qty');
Route::post('/basket/shipping/{id}', 'BasketController@updateShipping')->name('basket.update-shipping');
Route::delete('/basket/{id}/{declinationId}', 'BasketController@destroy')->name('basket.delete');

Route::get('/users/show', 'UsersController@show')->name('user.show');
Route::patch('/users/{id}', 'UsersController@update')->name('user.update');
Route::patch('/users/address/{user}', 'UsersController@updateAddress')->name('user.update.address');

Route::get('company/{company}', 'CompaniesController@show');

Route::get('/{category}/{subCategory?}/{finalCategory?}', 'CategoriesController@show')->name('category.show');
Route::get('/{category}/{subCategory}/{finalCategory}/{slug}', 'ProductsController@show')->name('product.show');
