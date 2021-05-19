<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'User\RegisterController@register');
Route::post('login', 'User\LoginController@login');
Route::get('banners', 'Banner\BannerController@index');

Route::prefix('books')->group(function(){
    Route::get('new', 'Book\BookController@new');
    Route::get('recommended', 'Book\BookController@recommended');
    Route::get('most', 'Book\BookController@most');
    Route::get('{id}/get', 'Book\BookController@get');
    
    Route::middleware('auth:api')->group(function(){
        Route::get('me', 'Book\BookController@me');
        Route::post('store', 'Book\BookController@store');
        Route::delete('delete', 'Book\BookController@delete');
    });
});

Route::prefix('categories')->group(function(){
    Route::get('', 'Category\CategoryController@index');
    Route::get('{id}/books', 'Category\CategoryController@get');
});

Route::prefix('orders')->group(function(){
    Route::post('', 'Order\OrderController@store');
    Route::get('me', 'Order\OrderController@me');
});
