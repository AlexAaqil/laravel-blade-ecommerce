<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    public function destroy($id) {
        $image = ProductImage::find($id);

        if($image) {
            // Delete from storage
            Storage::delete('public/product_images/' . $image->image);

            // Delete from database
            $image->delete();
        }

        return redirect()->back()->with('success',['message' => 'Image has been deleted']);
    }

    public function sort(Request $request)
    {
        return $this->sort_items($request, ProductImage::class);
    }
}
