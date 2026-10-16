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

            <form action="{{ route('cart.add', $viewData['product']->getId()) }}" method="POST" class="d-flex gap-2 mt-3 col-md-4">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $viewData['product']->getStock() }}" class="form-control">
                <button type="submit" class="btn btn-dark text-nowrap">{{ __('cart.add') }}</button>
            </form>
            @error('quantity')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        @else
            <span class="badge bg-secondary">{{ __('catalog.out_of_stock') }}</span>
        @endif

        <hr class="my-4">

        <h2 class="h4">{{ __('reviews.title') }} ({{ $viewData['product']->getReviews()->count() }})</h2>

        @if ($viewData['product']->getReviews()->isNotEmpty())
            <p class="text-muted">
                {{ __('reviews.average') }}: {{ __('reviews.out_of', ['rating' => $viewData['product']->getAverageRating()]) }}
            </p>
        @endif

        @forelse ($viewData['product']->getReviews() as $review)
            <div class="border rounded p-3 mb-3">
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