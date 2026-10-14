<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['categories'] = Category::with('products')->orderBy('name')->paginate(10);

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['category'] = Category::findOrFail($id);

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(UpdateCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.categories.index');
    }
}
