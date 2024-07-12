<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Blog;

class GeneralPagesController extends Controller
{
    public function home()
    {
        $products = Product::where('is_visible', 1)->orderBy('ordering')->orderBy('title')->take(4)->get();
        $blogs = Blog::orderBy('ordering')->take(3)->get();

        return view("index", compact('products', 'blogs'));
    }
    
    public function shop()
    {
        $products = Product::where('is_visible', 1)->orderBy('ordering')->orderBy('title')->get();
        $categories = ProductCategory::orderBy('title')->get();

        return view("shop", compact('products', 'categories'));
    }
}
