<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public section ("/")
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Auth routes
Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin section ("/admin/*")
|--------------------------------------------------------------------------
| Only authenticated users with the admin role can enter.
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', 'App\Http\Controllers\Admin\HomeController@index')->name('home');

    // Products
    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index')->name('products.index');
    Route::get('/products/create', 'App\Http\Controllers\Admin\ProductController@create')->name('products.create');
    Route::post('/products', 'App\Http\Controllers\Admin\ProductController@store')->name('products.store');
    Route::get('/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('products.edit');
    Route::put('/products/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('products.update');
    Route::delete('/products/{id}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('products.destroy');

    // Categories
    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('categories.index');
    Route::get('/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('categories.create');
    Route::post('/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('categories.store');
    Route::get('/categories/{id}/edit', 'App\Http\Controllers\Admin\CategoryController@edit')->name('categories.edit');
    Route::put('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('categories.update');
    Route::delete('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('categories.destroy');
});
