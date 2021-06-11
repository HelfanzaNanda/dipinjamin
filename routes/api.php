<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', 'User\RegisterController@register');
Route::post('login', 'User\LoginController@login');
Route::post('login/provider', 'User\LoginController@loginProvider');
Route::get('banners', 'Banner\BannerController@index');

Route::prefix('books')->group(function(){
	Route::get('new', 'Book\BookController@new');
	Route::get('recommended', 'Book\BookController@recommended');
	Route::get('most', 'Book\BookController@most');
	Route::get('category/{id}', 'Book\BookController@byCategory');
	Route::get('search/{title}', 'Book\BookController@search');
	Route::get('{id}/get', 'Book\BookController@get');
	
	Route::middleware('auth:api')->group(function(){
		Route::get('me', 'Book\BookController@me');
		Route::get('{id}/me', 'Book\BookController@getBookMe');
		Route::post('store', 'Book\BookController@store');
		Route::delete('/{id}/delete', 'Book\BookController@delete');
	});
});

Route::prefix('categories')->group(function(){
	Route::get('', 'Category\CategoryController@index');
	Route::get('{id}/books', 'Category\CategoryController@get');
});

Route::prefix('orders')->group(function(){
	Route::get('by-borrower', 'Order\OrderController@byBorrower');
	Route::get('by-owner', 'Order\OrderController@byOwner');
	Route::post('', 'Order\OrderController@store');
});


Route::prefix('user')->middleware('auth:api')->group(function(){
	Route::get('', 'User\UserController@currentUser');
	Route::post('/password', 'User\UserController@updatePassword');
	Route::post('', 'User\UserController@updateUser');
});

Route::prefix('delivery-addresses')->middleware('auth:api')->group(function(){
	Route::get('', 'DeliveryAddresses\DeliveryAddressesController@index');
	Route::post('', 'DeliveryAddresses\DeliveryAddressesController@store');
	Route::get('{id}/get', 'DeliveryAddresses\DeliveryAddressesController@get');
	Route::delete('{id}/delete', 'DeliveryAddresses\DeliveryAddressesController@delete');
});

Route::prefix('carts')->middleware('auth:api')->group(function(){
	Route::get('', 'Cart\CartController@index');
	Route::post('', 'Cart\CartController@store');
	Route::delete('{id}/delete', 'Cart\CartController@delete');
});

Route::get('check-user-is-added-cart/{bookId}', 'Cart\CheckUserIsAddedCartController');


Route::middleware('cors')->group(function(){

});