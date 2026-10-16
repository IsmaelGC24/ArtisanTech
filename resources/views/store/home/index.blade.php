@extends('layouts.app')

@section('title', __('home.title'))

@section('content')
    <div class="container py-5">
        <h1>{{ __('home.welcome', ['name' => config('app.name')]) }}</h1>
        <p class="lead">{{ __('home.subtitle') }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark">{{ __('home.view_products') }}</a>
    </div>
@endsection