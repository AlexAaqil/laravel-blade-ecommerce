<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\product\ProductMeasurement;
use App\Models\product\ProductCategory;
use App\Models\product\ProductImage;
use App\Models\product\ProductReview;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->orderBy('ordering')
        ->orderBy('title')
        ->get();
        $measurements = ProductMeasurement::count();
        $categories = ProductCategory::count();
        $reviews = ProductReview::count();

        return view('admin.products.index', compact('products', 'measurements', 'categories', 'reviews'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('title')->get();
        $measurements = ProductMeasurement::orderBy('unit')->get();

        return view('admin.products.create', compact('categories', 'measurements'));
    }

    public function store(Request $request)
    {
        // Custom validation logic for discount
        $request->validate([
            'discount_amount' => 'numeric|nullable',
            'discount_percentage' => 'numeric|nullable',
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:120|unique:products',
            'product_code' => 'nullable|string',
            'is_featured' => 'required|boolean',
            'is_visible' => 'required|boolean',
            'category_id' => 'nullable|numeric',
            'measurement_id' => 'nullable|numeric',
            'buying_price' => 'numeric',
            'selling_price' => 'numeric',
            'stock_count' => 'numeric',
            'safety_stock' => 'numeric',
            'images' => 'max:2048',
            'description' => 'nullable|string',
        ]);

        // Check that only one of discount_amount or discount_percentage is entered
        if ($request->discount_amount && $request->discount_percentage) {
            return redirect()->back()->withErrors(['discount' => 'You can only enter either the discount amount or the discount percentage, not both.'])->withInput();
        }

        // Ensure only one is saved in the DB and values are sensible
        if ($request->filled('discount_amount')) {
            if ($request->discount_amount > $request->selling_price) {
                return redirect()->back()->withErrors(['discount' => 'Discount amount cannot be more than the selling price'])->withInput();
            }
            $validated['discount_percentage'] = 0;
            $validated['discount_amount'] = $request->discount_amount;
        } elseif ($request->filled('discount_percentage')) {
            if ($request->discount_percentage > 100) {
                return redirect()->back()->withErrors(['discount' => 'Discount percentage cannot be more than 100%'])->withInput();
            }
            $validated['discount_amount'] = 0;
            $validated['discount_percentage'] = $request->discount_percentage;
        } else {
            // If neither discount amount nor discount percentage is provided, ensure both are set to null
            $validated['discount_amount'] = 0;
            $validated['discount_percentage'] = 0;
        }

        $validated['slug'] = Str::slug($validated['title']);

        $product = Product::create($validated);

        $this->storeProductImages($request, $product);

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been added']);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(5)
        ->get();

        return view('product.details', compact('product', 'related_products'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('title')->get();
        $measurements = ProductMeasurement::orderBy('unit')->get();

        return view('admin.products.edit', compact('categories', 'measurements', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        // Custom validation logic for discount
        $request->validate([
            'discount_amount' => 'numeric|nullable',
            'discount_percentage' => 'numeric|nullable',
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:120|unique:products,title,' . $product->id,
            'product_code' => 'nullable|string',
            'is_featured' => 'required|boolean',
            'is_visible' => 'required|boolean',
            'category_id' => 'nullable|numeric',
            'measurement_id' => 'nullable|numeric',
            'buying_price' => 'numeric',
            'selling_price' => 'numeric',
            'stock_count' => 'numeric',
            'safety_stock' => 'numeric',
            'images' => 'max:2048',
            'description' => 'nullable|string',
        ]);


        // Custom logic to check that only one of discount_amount or discount_percentage is entered
        if ($request->discount_amount && $request->discount_percentage) {
            return redirect()->back()->withErrors(['discount' => 'Only enter either the discount amount or the discount percentage, not both.'])->withInput();
        }

        // Ensure only one is saved in the DB and values are sensible
        if ($request->filled('discount_amount')) {
            if ($request->discount_amount > $request->selling_price) {
                return redirect()->back()->withErrors(['discount' => 'Discount amount cannot be more than the selling price'])->withInput();
            }
            $validated['discount_percentage'] = 0;
            $validated['discount_amount'] = $request->discount_amount;
        } elseif ($request->filled('discount_percentage')) {
            if ($request->discount_percentage > 100) {
                return redirect()->back()->withErrors(['discount' => 'Discount percentage cannot be more than 100%'])->withInput();
            }
            $validated['discount_amount'] = 0;
            $validated['discount_percentage'] = $request->discount_percentage;
        } else {
            // If neither discount amount nor discount percentage is provided, ensure both are set to null
            $validated['discount_amount'] = 0;
            $validated['discount_percentage'] = 0;
        }

        $validated['slug'] = Str::slug($validated['title']);

        $product->update($validated);

        // Retrieve existing images
        $existing_images = $product->images;

        // Rename existing images to reflect the new title
        foreach($existing_images as $image) {
            $old_filename = 'product_images/' . $image->image;
            $extension = pathinfo($image->image, PATHINFO_EXTENSION);
            $new_filename = Str::slug($validated['title']) . '-' . uniqid() . '.' . $extension;
            $new_path = 'product_images/' . $new_filename;

            if(Storage::disk('public')->exists($old_filename)) {
                Storage::disk('public')->move($old_filename, $new_path);
                $image->image = $new_filename;
                $image->save();
            }
        }

        // Check if new images are being uploaded
        $images = $request->file('images');
        if ($images) {
            $total_images = $existing_images->count() + count($images);

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
        $images = $product->images->pluck('image')->toArray();

        // Delete the images from the DB
        $product->images()->delete();

        // Delete the product itself
        $product->delete();

        // Delete the images from storage
        foreach($images as $image) {
            Storage::disk('public')->delete('product_images/' . $image);
        }

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been deleted.']);
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
