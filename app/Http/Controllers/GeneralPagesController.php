<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;

class GeneralPagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        $featured_products = Product::where([
            ['featured', 1],
            // ['stock_count', '>', 0]
        ])
        ->orderBy('product_order')
        ->take(4)
        ->get();

        $testimonials = ProductReview::take(3)->get();

        return view('index', compact('featured_products', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function shop()
    {
        $products = Product::orderBy('title','asc')->get();
        $product_categories = ProductCategory::orderBy('title','asc')->take(18)->get();
        
        return view('shop', compact('products', 'product_categories'));
    }

    public function contact()
    {
        return view('contact');
    }
}
