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

Route::middleware('session')->group(function () {
    Route::get('/profile/show/{userId?}', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/addresses/{userId}', 'ProfileController@showAddresses')->name('profile.addresses');
    Route::get('/profile/orders/{userId}', 'ProfileController@showOrders')->name('profile.orders');
    Route::get('/profile/favorites/{userId}', 'ProfileController@showFavorites')->name('profile.favorites');
    
    Route::patch('/basket/address/{userId}', 'BasketController@updateAddress')->name('basket.update-address');
    Route::post('/checkout', 'BasketController@turnIntoOrder');

    Route::patch('/users/address/{userId}', 'UsersController@updateAddress')->name('user.update.address');
    
    Route::post('/favorites/addToFavorites', 'FavoritesController@addToFavorites')->name('favorite.add');
    Route::post('/favorites/isFavorited', 'FavoritesController@isFavorited');
    Route::post('/favorites/removeFavorite', 'FavoritesController@removeFavorite');

    Route::get('/basket/address', 'BasketController@showAddress');

    Route::get('/basket/invoice', 'BasketController@generateInvoicePDF');
});

Route::get('/', 'HomeController@index')->name('home');

Route::post('/newsletter', 'NewsletterController@store')->name('newsletter');

Route::get('/search', 'Api\SearchController@index');
Route::get('/searchbox', 'Api\SearchController@searchAlgolia');

Route::get('/basket', 'BasketController@index');
Route::post('/basket/add', 'BasketController@addProduct')->name('basket.add');
Route::get('/checkout', 'BasketController@checkout');
Route::post('/basket/update/{id}', 'BasketController@updateQuantity')->name('basket.update-qty');
Route::post('/basket/shipping/{id}', 'BasketController@updateShipping')->name('basket.update-shipping');
Route::delete('/basket/{id}/{declinationId}', 'BasketController@destroy')->name('basket.delete');

Route::get('/users/password/reset', 'UsersController@resetPassword')->name('password_reset');
Route::post('/users/password', 'UsersController@forgotPassword')->name('forgot_password');
Route::patch('/users/{id}', 'UsersController@update')->name('user.update');

Route::get('/company/{company}', 'CompaniesController@show');

Route::get('/{category}/{subCategory?}/{finalCategory?}', 'CategoriesController@show')->name('category.show');
Route::get('/{category}/{subCategory}/{finalCategory}/{slug}', 'ProductsController@show')->name('product.show');
