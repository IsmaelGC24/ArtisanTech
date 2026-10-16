<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['brands'] = Brand::with('products')->orderBy('name')->paginate(10);

        return view('admin.brands.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];

        return view('admin.brands.create')->with('viewData', $viewData);
    }

    public function store(StoreBrandRequest $request): RedirectResponse
    {
        Brand::create($request->validated());

        return redirect()->route('admin.brands.index');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['brand'] = Brand::findOrFail($id);

        return view('admin.brands.edit')->with('viewData', $viewData);
    }

    public function update(UpdateBrandRequest $request, string $id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        $brand->update($request->validated());

        return redirect()->route('admin.brands.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        Brand::findOrFail($id)->delete();

        return redirect()->route('admin.brands.index');
    }
}
