<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\product\ProductMeasurement;
use App\Models\product\ProductCategory;
use App\Models\product\ProductImage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->orderBy('ordering')
        ->orderBy('title')
        ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('title')->get();
        $measurements = ProductMeasurement::orderBy('unit')->get();

        return view('admin.products.create', compact('categories', 'measurements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:120|unique:products',
            'product_code' => 'nullable|string',
            'is_featured' => 'required|boolean',
            'is_visible' => 'required|boolean',
            'category_id' => 'nullable|numeric',
            'measurement_id' => 'nullable|numeric',
            'buying_price' => 'numeric',
            'selling_price' => 'numeric',
            'discount_amount' => 'numeric',
            'discount_percentage' => 'numeric',
            'stock_count' => 'numeric',
            'safety_stock' => 'numeric',
            'images' => 'max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $product = Product::create($validated);

        $this->storeProductImages($request, $product);

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    private function storeProductImages(Request $request, Product $product)
    {
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $filename = $this->generateImageFilename($image, $product->title, $product->id);
                $image->storeAs('product_images', $filename, 'public');

                $image_upload = new ProductImage;
                $image_upload->image = $filename;
                $image_upload->product_id = $product->id;

                $image_upload->save();
            }
        }
    }

    private function generateImageFilename($image, $title, $productId)
    {
        $extension = $image->getClientOriginalExtension();
        $slug = Str::slug($title);
        return "{$slug}-" . uniqid() . ".$extension";
    }
}
