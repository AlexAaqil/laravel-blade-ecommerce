<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductReview;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::orderBy('ordering')->orderBy('created_at')->get();

        return view('admin.products.reviews.index', compact('reviews'));
    }

    public function create($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();

        return view('product.review', compact('product'));
    }

    public function store(Request $request, $product)
    {
        $product = Product::findOrFail($product);

        $validated = $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|string|max:1500',
            'ordering' => 'numeric',
            'is_visible' => 'boolean',
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['product_id'] = $product->id;

        ProductReview::create($validated);

        return redirect()->route('products.show', $product->slug)->with('success', ['message' => 'Thank you for the review']);
    }

    public function show(ProductReview $productReview)
    {
        //
    }

    public function edit(ProductReview $product_review)
    {
        return view('admin.products.reviews.edit', compact('product_review'));
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
