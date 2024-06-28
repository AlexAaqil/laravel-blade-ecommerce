<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Blog;

class GeneralPagesController extends Controller
{
    public function home()
    {
        $products = Product::where('is_visible', 1)->orderBy('ordering')->orderBy('title')->get();
        $blogs = Blog::orderBy('ordering')->take(3)->get();

        return view("index", compact('products', 'blogs'));
    }

    public function about()
    {
        return view("about");
    }

    public function services()
    {
        return view("services");
    }

    public function contact()
    {
        return view("contact");
    }
}
