@extends('layouts.app')

@section('title', __('catalog.title'))

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('catalog.breadcrumb_home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('catalog.breadcrumb_products') }}</li>
            </ol>
        </nav>

        <h1 class="mb-4">{{ __('catalog.title') }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET" class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="q" value="{{ $viewData['term'] }}" class="form-control"
                               placeholder="{{ __('catalog.search_placeholder') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="category_id" class="form-select">
                            <option value="">{{ __('catalog.all_categories') }}</option>
                            @foreach ($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}" @selected($viewData['selectedCategoryId'] === $category->getId())>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="brand_id" class="form-select">
                            <option value="">{{ __('catalog.all_brands') }}</option>
                            @foreach ($viewData['brands'] as $brand)
                                <option value="{{ $brand->getId() }}" @selected($viewData['selectedBrandId'] === $brand->getId())>
                                    {{ $brand->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-dark flex-fill">{{ __('catalog.filter') }}</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">{{ __('catalog.clear') }}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-3 g-md-4 mb-4">
            @forelse ($viewData['products'] as $product)
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100">
                        <div class="card-body">
                            <h2 class="h5 card-title mb-1">{{ $product->getName() }}</h2>
                            <p class="product-meta mb-3">{{ $product->getBrand()->getName() }} · {{ $product->getCategory()->getName() }}</p>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <span class="price fs-5">{{ $product->getFormattedPrice() }}</span>
                                @if ($product->checkAvailability())
                                    <span class="badge badge-stock badge-stock-in">{{ __('catalog.in_stock') }}</span>
                                @else
                                    <span class="badge badge-stock badge-stock-out">{{ __('catalog.out_of_stock') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                            <a href="{{ route('products.show', $product->getId()) }}" class="btn btn-outline-dark btn-sm">
                                {{ __('catalog.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">{{ __('catalog.empty') }}</p>
            @endforelse
        </div>

        {{ $viewData['products']->links('pagination::bootstrap-5') }}
    </div>
@endsection