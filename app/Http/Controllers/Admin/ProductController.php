<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::with(['brand', 'category'])->latest()->paginate(10);

        return view('admin.products.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['brands'] = Brand::orderBy('name')->get();
        $viewData['categories'] = Category::orderBy('name')->get();

        return view('admin.products.create')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['active'] = $request->boolean('active');
        Product::create($data);

        return redirect()->route('admin.products.index');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['product'] = Product::findOrFail($id);
        $viewData['brands'] = Brand::orderBy('name')->get();
        $viewData['categories'] = Category::orderBy('name')->get();

        return view('admin.products.edit')->with('viewData', $viewData);
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $data['active'] = $request->boolean('active');
        $product->update($data);

        return redirect()->route('admin.products.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('admin.products.index');
    }
}