<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function destroy(Request $request, string $id): RedirectResponse
    {
        $review = Review::findOrFail($id);

        if (! $review->canBeDeletedBy($request->user())) {
            abort(403);
        }

        $productId = $review->getProductId();
        $review->delete();

        return redirect()->route('products.show', $productId);
    }
}
