<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::latest()->get();

        return view('admin.product_reviews.index', compact('reviews'));
    }

    public function create($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();

        return view('product_reviews.create', compact('product'));
    }

    public function store(Request $request, $product)
    {
        $product = Product::findOrFail($product);

        $validated = $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|string|max:1500',
            'image' => 'nullable|max:2048',
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['product_id'] = $product->id;

        ProductReview::create($validated);

        return redirect()->route('shop')->with('success', ['message' => 'Your review has been sent']);
    }

    public function show(ProductReview $product_review)
    {
        //
    }

    public function edit(ProductReview $product_review)
    {
        return view('admin.product_reviews.edit', compact('product_review'));
    }

    public function update(Request $request, ProductReview $product_review)
    {
        $validated = $request->validate([
            'is_visible' => 'required|numeric',
            'ordering' => 'numeric',
        ]);

        $product_review->update($validated);

        return redirect()->route('product-reviews.index')->with('success', ['message' => 'Product Review has been updated']);
    }

    public function destroy(ProductReview $product_review)
    {
        $product_review->delete();

        return redirect()->route('product-reviews.index')->with('success', ['message' => 'Product review has been deleted']);
    }
}
