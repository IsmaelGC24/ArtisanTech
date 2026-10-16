@extends('layouts.app')

@section('title', __('catalog.title'))

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">{{ __('catalog.title') }}</h1>

        <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-4">
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
                <button type="submit" class="btn btn-dark">{{ __('catalog.filter') }}</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">{{ __('catalog.clear') }}</a>
            </div>
        </form>

        <div class="row">
            @forelse ($viewData['products'] as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->getName() }}</h5>
                            <p class="text-muted mb-1">{{ $product->getBrand()->getName() }} · {{ $product->getCategory()->getName() }}</p>
                            <p class="fw-bold fs-5 mb-2">{{ $product->getFormattedPrice() }}</p>
                            @if ($product->checkAvailability())
                                <span class="badge bg-success">{{ __('catalog.in_stock') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('catalog.out_of_stock') }}</span>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-0">
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