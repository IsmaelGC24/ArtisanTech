@extends('layouts.app')

@section('title', $viewData['product']->getName())

@section('content')
    <div class="container py-4">
        <a href="{{ route('products.index') }}" class="btn btn-link px-0 mb-3">&larr; {{ __('catalog.back') }}</a>

        <h1>{{ $viewData['product']->getName() }}</h1>
        <p class="text-muted">
            {{ $viewData['product']->getBrand()->getName() }} · {{ $viewData['product']->getCategory()->getName() }}
        </p>
        <p class="fs-3 fw-bold">{{ $viewData['product']->getFormattedPrice() }}</p>
        <p>{{ $viewData['product']->getDescription() ?? __('catalog.no_description') }}</p>

        @if ($viewData['product']->checkAvailability())
            <span class="badge bg-success">{{ __('catalog.in_stock') }}</span>
            <span class="text-muted ms-2">{{ __('catalog.units', ['count' => $viewData['product']->getStock()]) }}</span>
        @else
            <span class="badge bg-secondary">{{ __('catalog.out_of_stock') }}</span>
        @endif
    </div>
@endsection