<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['productsCount'] = Product::count();
        $viewData['categoriesCount'] = Category::count();
        $viewData['brandsCount'] = Brand::count();
        $viewData['outOfStockCount'] = Product::where('stock', 0)->count();

        return view('admin.home.index')->with('viewData', $viewData);
    }
}