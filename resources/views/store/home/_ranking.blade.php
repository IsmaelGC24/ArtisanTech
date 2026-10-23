<h2 class="h4 mb-3">{{ $title }}</h2>
<div class="row mb-5">
    @foreach ($products as $product)
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="text-muted mb-1">{{ $product->getBrand()->getName() }}</p>
                    <p class="fw-bold mb-1">{{ $product->getFormattedPrice() }}</p>
                    <p class="small text-muted mb-0">
                        @if ($metric === 'sold')
                            {{ trans_choice('home.units_sold', $product->getUnitsSold()) }}
                        @else
                            {{ trans_choice('home.reviews_count', $product->getReviewsCount()) }}
                        @endif
                    </p>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('products.show', $product->getId()) }}" class="btn btn-outline-dark btn-sm">
                        {{ __('catalog.view_details') }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>