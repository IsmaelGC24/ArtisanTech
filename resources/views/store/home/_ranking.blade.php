<h2 class="h4 mb-3">{{ $title }}</h2>
<div class="row g-3 g-md-4 mb-5">
    @foreach ($products as $product)
        <div class="col-sm-6 col-lg-3">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <h3 class="h6 card-title mb-1">{{ $product->getName() }}</h3>
                    <p class="product-meta mb-2">{{ $product->getBrand()->getName() }}</p>
                    <p class="price fs-5 mb-1">{{ $product->getFormattedPrice() }}</p>
                    <p class="small text-muted mb-0">
                        @if ($metric === 'sold')
                            {{ trans_choice('home.units_sold', $product->getUnitsSold()) }}
                        @else
                            {{ trans_choice('home.reviews_count', $product->getReviewsCount()) }}
                        @endif
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                    <a href="{{ route('products.show', $product->getId()) }}" class="btn btn-outline-dark btn-sm">
                        {{ __('catalog.view_details') }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
