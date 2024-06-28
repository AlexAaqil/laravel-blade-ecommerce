<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('title')->get();

        return view('admin.products.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:product_categories',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        ProductCategory::create($validated);

        return redirect()->back()->with('success', ['message' => 'Product category has been created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $product_category)
    {
        //
    }

    public function edit(ProductCategory $product_category)
    {
        return view('admin.products.categories.edit', compact('product_category'));
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:product_categories,title,' . $product_category->id,
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $product_category->update($validated);

        return redirect()->route('product-categories.index')->with('success', ['message' => 'Product category has been updated']);
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();

        return redirect()->route('product-categories.index')->with('success', ['message' => 'Product category has been deleted']);
    }
}
