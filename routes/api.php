<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', 'App\Http\Controllers\Api\ProductApiController@index')->name('api.products.index');
