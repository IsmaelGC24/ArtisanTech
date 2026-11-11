@extends('layouts.app')

@section('title', $viewData['product']->getName())

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('catalog.breadcrumb_home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{ __('catalog.breadcrumb_products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $viewData['product']->getName() }}</li>
            </ol>
        </nav>

        <div class="card mb-5">
            <div class="card-body p-4 p-md-5">
                <h1 class="mb-1">{{ $viewData['product']->getName() }}</h1>
                <p class="product-meta mb-3">
                    {{ $viewData['product']->getBrand()->getName() }} · {{ $viewData['product']->getCategory()->getName() }}
                </p>
                <p class="price fs-2 mb-3">{{ $viewData['product']->getFormattedPrice() }}</p>
                <p class="mb-4">{{ $viewData['product']->getDescription() ?? __('catalog.no_description') }}</p>

                @if ($viewData['product']->checkAvailability())
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="badge badge-stock badge-stock-in">{{ __('catalog.in_stock') }}</span>
                        <span class="text-muted small">{{ __('catalog.units', ['count' => $viewData['product']->getStock()]) }}</span>
                    </div>

                    <form action="{{ route('cart.add', $viewData['product']->getId()) }}" method="POST" class="row g-2 mt-3">
                        @csrf
                        <div class="col-4 col-md-2">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $viewData['product']->getStock() }}" class="form-control">
                        </div>
                        <div class="col-8 col-md-auto">
                            <button type="submit" class="btn btn-dark w-100 text-nowrap">{{ __('cart.add') }}</button>
                        </div>
                    </form>
                    @error('quantity')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                @else
                    <span class="badge badge-stock badge-stock-out">{{ __('catalog.out_of_stock') }}</span>
                @endif
            </div>
        </div>

        <h2 class="h4">{{ __('reviews.title') }} ({{ $viewData['product']->getReviews()->count() }})</h2>

        @if ($viewData['product']->getReviews()->isNotEmpty())
            <p class="text-muted">
                {{ __('reviews.average') }}: {{ __('reviews.out_of', ['rating' => $viewData['product']->getAverageRating()]) }}
            </p>
        @endif

        @forelse ($viewData['product']->getReviews() as $review)
            <div class="card card-body mb-3">
                <div class="d-flex justify-content-between">
                    <strong>{{ $review->getUser()->getName() }}</strong>
                    <span class="text-muted small">{{ $review->getFormattedDate() }}</span>
                </div>
                <div class="text-warning">{{ str_repeat('★', $review->getRating()) }}{{ str_repeat('☆', 5 - $review->getRating()) }}</div>
                @if ($review->getComment())
                    <p class="mb-0 mt-2">{{ $review->getComment() }}</p>
                @endif
                @auth
                    @if ($review->canBeDeletedBy(auth()->user()))
                        <form action="{{ route('reviews.destroy', $review->getId()) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('{{ __('reviews.confirm_delete') }}')" class="btn btn-outline-danger btn-sm">
                                {{ __('reviews.delete') }}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <p class="text-muted">{{ __('reviews.none') }}</p>
        @endforelse

        <h3 class="h5 mt-4">{{ __('reviews.write') }}</h3>
        @auth
            <form action="{{ route('reviews.store', $viewData['product']->getId()) }}" method="POST" class="col-md-6">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('reviews.rating') }}</label>
                    <select name="rating" class="form-select">
                        <option value="">{{ __('reviews.select_rating') }}</option>
                        @for ($stars = 5; $stars >= 1; $stars--)
                            <option value="{{ $stars }}" @selected((int) old('rating') === $stars)>{{ str_repeat('★', $stars) }}</option>
                        @endfor
                    </select>
                    @error('rating')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('reviews.comment') }}</label>
                    <textarea name="comment" rows="3" class="form-control">{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark">{{ __('reviews.submit') }}</button>
            </form>
        @else
            <p class="text-muted">
                <a href="{{ route('login') }}">{{ __('reviews.login_required') }}</a>
            </p>
        @endauth
    </div>
@endsection