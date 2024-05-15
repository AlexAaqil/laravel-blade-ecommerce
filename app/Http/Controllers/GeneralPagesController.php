<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralPagesController extends Controller
{
    public function home()
    {
        return view("index");
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
