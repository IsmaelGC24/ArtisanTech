<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['products'] = Product::with(['brand', 'category'])
            ->where('active', true)
            ->when($request->query('q'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'))
            ->when($request->query('category_id'), fn ($query, $id) => $query->where('category_id', $id))
            ->when($request->query('brand_id'), fn ($query, $id) => $query->where('brand_id', $id))
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();
        $viewData['categories'] = Category::orderBy('name')->get();
        $viewData['brands'] = Brand::orderBy('name')->get();
        $viewData['term'] = (string) $request->query('q', '');
        $viewData['selectedCategoryId'] = (int) $request->query('category_id', 0);
        $viewData['selectedBrandId'] = (int) $request->query('brand_id', 0);

        return view('store.products.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData['product'] = Product::with([
            'brand',
            'category',
            'reviews' => fn ($query) => $query->latest(),
            'reviews.user',
        ])
            ->where('active', true)
            ->findOrFail($id);

        return view('store.products.show')->with('viewData', $viewData);
    }
}
