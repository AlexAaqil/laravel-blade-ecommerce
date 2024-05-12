<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::latest()->get();

        return view('admin.product_categories.index', compact('product_categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:product_categories',
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        ProductCategory::create($validated);

        return redirect()->route('product-categories.index')->with('success', ['message' => 'Product category has been created.']);
    }

    public function edit(ProductCategory $product_category)
    {
        return view('admin.product_categories.edit', compact('product_category'));
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:product_categories,title,' . $product_category->id,
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        $product_category->update($validated);

        return redirect()->route('product-categories.index')->with('success', ['message' => 'Product category has been updated.']);
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();

        return redirect()->route('product-categories.index')->with('success', ['message' => 'Product category has been deleted.']);
    }
}
