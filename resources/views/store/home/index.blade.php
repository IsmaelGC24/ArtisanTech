@extends('layouts.app')

@section('title', __('home.title'))

@section('content')
    <div class="container py-5">
        <h1>{{ __('home.welcome', ['name' => config('app.name')]) }}</h1>
        <p class="lead">{{ __('home.subtitle') }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark mb-5">{{ __('home.view_products') }}</a>

        @if ($viewData['topSelling']->isNotEmpty())
            @include('store.home._ranking', ['title' => __('home.top_selling'), 'products' => $viewData['topSelling'], 'metric' => 'sold'])
        @endif

        @if ($viewData['topCommented']->isNotEmpty())
            @include('store.home._ranking', ['title' => __('home.top_commented'), 'products' => $viewData['topCommented'], 'metric' => 'reviews'])
        @endif
    </div>
@endsection