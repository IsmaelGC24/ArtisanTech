@extends('layouts.app')

@section('title', __('home.title'))

@section('content')
    <div class="container py-4 py-md-5">
        <section class="hero mb-5">
            <h1 class="display-5 fw-bold mb-2">{{ __('home.welcome', ['name' => config('app.name')]) }}</h1>
            <p class="lead mb-1">{{ __('home.subtitle') }}</p>
            <p class="mb-4 text-white-50">{{ __('home.hero_text') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">{{ __('home.view_products') }}</a>
        </section>

        @if ($viewData['topSelling']->isNotEmpty())
            @include('store.home._ranking', ['title' => __('home.top_selling'), 'products' => $viewData['topSelling'], 'metric' => 'sold'])
        @endif

        @if ($viewData['topCommented']->isNotEmpty())
            @include('store.home._ranking', ['title' => __('home.top_commented'), 'products' => $viewData['topCommented'], 'metric' => 'reviews'])
        @endif
    </div>
@endsection
