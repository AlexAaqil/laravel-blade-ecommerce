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

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('title')->get();
        $measurements = ProductMeasurement::orderBy('unit')->get();

        return view('admin.products.edit', compact('categories', 'measurements', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:120|unique:products,title,' . $product->id,
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

        $product->update($validated);

        // Retrieve existing images
        $existing_images = $product->images()->pluck('image')->toArray();

        // Check if new images are being uploaded
        $images = $request->file('images');
        if ($images) {
            $total_images = count($existing_images) + count($images);

            // Check if the total number of images doesn't exceed five
            if ($total_images <= 5) {
                foreach ($images as $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = Str::slug($validated['title']) . '-' . uniqid() . '.' .$extension;

                    $image->storeAs('product_images', $filename, 'public');

                    $image_upload = new ProductImage;
                    $image_upload->image = $filename;
                    $image_upload->product_id = $product->id;

                    $image_upload->save();
                }
            } else {
                return redirect()->route('products.edit', $product->id)->withErrors(['images' => 'You can only upload a maximum of five images.'])->withInput();
            }
        }

        return redirect()->back()->with('success', ['message' => 'Product has been updated.']);
    }

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
