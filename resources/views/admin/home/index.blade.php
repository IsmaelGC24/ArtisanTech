@extends('layouts.admin')

@section('title', __('admin.dashboard'))

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('admin.dashboard') }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded shadow p-6">
            <p class="text-sm text-gray-500">{{ __('admin.total_products') }}</p>
            <p class="text-3xl font-bold text-gray-800">{{ $viewData['productsCount'] }}</p>
        </div>
        <div class="bg-white rounded shadow p-6">
            <p class="text-sm text-gray-500">{{ __('admin.total_categories') }}</p>
            <p class="text-3xl font-bold text-gray-800">{{ $viewData['categoriesCount'] }}</p>
        </div>
        <div class="bg-white rounded shadow p-6">
            <p class="text-sm text-gray-500">{{ __('admin.total_brands') }}</p>
            <p class="text-3xl font-bold text-gray-800">{{ $viewData['brandsCount'] }}</p>
        </div>
        <div class="bg-white rounded shadow p-6">
            <p class="text-sm text-gray-500">{{ __('admin.out_of_stock') }}</p>
            <p class="text-3xl font-bold text-red-600">{{ $viewData['outOfStockCount'] }}</p>
        </div>
    </div>
@endsection