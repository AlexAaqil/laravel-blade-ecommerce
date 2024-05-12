<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMeasurement;
use App\Models\ProductImages;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_category', 'getProductImages')->orderBy('product_order', 'asc')
        ->orderBy('title', 'asc')
        ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $measurement_units = ProductMeasurement::all();

        return view('admin.products.create', compact('categories', 'measurement_units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:120|unique:products',
            'product_code' => 'numeric',
            'category_id' => 'nullable',
            'stock_count' => 'numeric',
            'safety_stock' => 'numeric',
            'buying_price' => 'numeric',
            'selling_price' => 'numeric',
            'discount_price' => 'numeric',
            'product_measurement' => 'nullable|numeric',
            'measurement_id' => 'nullable|numeric',
            'product_order' => 'nullable|numeric',
            'images' => 'max:2048',
            'description' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->featured;

        $product = Product::create($validated);

        $this->storeProductImages($request, $product);

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been added.']);
    }

    public function show($slug)
    {
        $product = Product::with('measurement_unit')->where('slug', $slug)->firstOrFail();
        $product_images = $product->getProductImages;
        $product_reviews = Product::with('product_reviews')->where('slug', $slug)->firstOrFail()->take(3);
        $related_products = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(5)
        ->get();
        return view('product_details', compact('product', 'product_images', 'related_products'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $measurement_units = ProductMeasurement::all();
        $product_images = $product->getProductImages;

        return view('admin.products.edit', compact('product', 'categories', 'measurement_units', 'product_images'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:120|unique:products,title,' . $product->id,
            'product_code' => 'numeric',
            'category_id' => 'nullable',
            'stock_count' => 'numeric',
            'safety_stock' => 'numeric',
            'buying_price' => 'numeric',
            'selling_price' => 'numeric',
            'discount_price' => 'numeric',
            'product_measurement' => 'nullable|numeric',
            'measurement_id' => 'nullable|numeric',
            'product_order' => 'nullable|numeric',
            'images' => 'max:2048',
            'description' => 'nullable',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->featured;
        
        $product->update($validated);

        // Retrieve existing images
        $existing_images = $product->getProductImages->pluck('image')->toArray();

        // Check if new images are being uploaded
        $images = $request->file('images');
        if ($images) {
            $total_images = count($existing_images) + count($images);

            // Check if the total number of images doesn't exceed five
            if ($total_images <= 5) {
                foreach ($images as $image) {
                    $random_string = date('Ymdhis').Str::random(5);
                    $extension = $image->getClientOriginalExtension();
                    $filename = $random_string. '.' .$extension;

                    $image_path = $image->storeAs('products', $filename, 'public');

                    $image_upload = new ProductImages;
                    $image_upload->image = $image_path;
                    $image_upload->product_id = $product->id;

                    $image_upload->save();
                }
            } else {
                return redirect()->route('products.edit', $product->id)->withErrors(['images' => 'You can only upload a maximum of five images.'])->withInput();
            }
        }

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been updated.']);
    }

    public function destroy(Product $product)
    {
        $image_paths = $product->getProductImages->pluck('image')->toArray();

        $product->getProductImages()->delete();

        $product->delete();

        foreach($image_paths as $image_path) {
            Storage::disk('public')->delete($image_path);
        }

        return redirect()->route('products.index')->with('success', ['message' => 'Product has been deleted.']);
    }

    public function search_products(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with('product_category')
        ->where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get();

        foreach ($products as $product) {
            $product->calculateDiscount();
        }

        return view('product_search_results', compact('products', 'query'));
    }

    public function categorized_products($category_slug)
    {
        $categories = ProductCategory::orderBy('title', 'asc')->get();
        $category = ProductCategory::where('slug', $category_slug)->firstOrFail();
        $products = $category->products()->get();

        foreach ($products as $product) {
            $product->calculateDiscount();
        }

        return view('product_categorized', compact('products', 'category', 'categories'));
    }

    public function product_images_sort(Request $request) {
        if(!empty($request->photo_id)) {
            $i = 1;
            foreach($request->photo_id as $photo_id) {
                $image = ProductImages::find($photo_id);
                $image->image_order = $i;
                $image->save();

                $i++;
            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    public function delete_product_image($id) {
        $image = ProductImages::find($id);

        $image->delete();

        Storage::disk('public')->delete($image->image);

        return redirect()->route('products.edit', $image->product_id)->with('success',['message' => 'Image has been deleted.']);
    }

    private function storeProductImages(Request $request, Product $product)
    {
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $filename = $this->generateImageFilename($image, $product->title, $product->id);
                $image_path = $image->storeAs('products', $filename, 'public');

                $image_upload = new ProductImages;
                $image_upload->image = $image_path;
                $image_upload->product_id = $product->id;

                $image_upload->save();
            }
        }
    }

    private function generateImageFilename($image, $title, $productId)
    {
        $extension = $image->getClientOriginalExtension();
        $slug = Str::slug($title);
        return "{$slug}-{$productId}-" . uniqid() . ".$extension";
    }
}
