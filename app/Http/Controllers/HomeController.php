<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['topCommented'] = Product::with('brand')
            ->withCount('reviews')
            ->where('active', true)
            ->whereHas('reviews')
            ->orderByDesc('reviews_count')
            ->orderBy('name')
            ->take(4)
            ->get();
        $viewData['topSelling'] = Product::with('brand')
            ->withSum('orderItems as units_sold', 'quantity')
            ->where('active', true)
            ->whereHas('orderItems')
            ->orderByDesc('units_sold')
            ->orderBy('name')
            ->take(4)
            ->get();

        return view('store.home.index')->with('viewData', $viewData);
    }
}
