<?php

use Illuminate\Support\Facades\Route;

/* 
Route::get('/', function () {
    return view('welcome');
});
    */

/*
|--------------------------------------------------------------------------
| Admin section ("/admin/*")
|--------------------------------------------------------------------------
| The 'auth' and 'admin' middleware are added when login is implemented.
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index')->name('products.index');
    Route::get('/products/create', 'App\Http\Controllers\Admin\ProductController@create')->name('products.create');
    Route::post('/products', 'App\Http\Controllers\Admin\ProductController@store')->name('products.store');
    Route::get('/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('products.edit');
    Route::put('/products/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('products.update');
    Route::delete('/products/{id}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('products.destroy');
});