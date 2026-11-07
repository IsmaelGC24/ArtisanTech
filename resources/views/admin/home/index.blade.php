@extends('layouts.admin')

@section('title', __('admin.dashboard'))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.dashboard') }}</h1>

    <div class="row g-3">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">{{ __('admin.total_products') }}</p>
                    <p class="display-6 fw-bold mb-0">{{ $viewData['productsCount'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">{{ __('admin.total_categories') }}</p>
                    <p class="display-6 fw-bold mb-0">{{ $viewData['categoriesCount'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">{{ __('admin.total_brands') }}</p>
                    <p class="display-6 fw-bold mb-0">{{ $viewData['brandsCount'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">{{ __('admin.out_of_stock') }}</p>
                    <p class="display-6 fw-bold text-danger mb-0">{{ $viewData['outOfStockCount'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection