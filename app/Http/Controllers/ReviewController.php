<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, string $id): RedirectResponse
    {
        $product = Product::where('active', true)->findOrFail($id);

        Review::create([
            'rating' => $request->validated('rating'),
            'comment' => $request->validated('comment'),
            'user_id' => $request->user()->getId(),
            'product_id' => $product->getId(),
        ]);

        return redirect()->route('products.show', $product->getId());
    }
}
