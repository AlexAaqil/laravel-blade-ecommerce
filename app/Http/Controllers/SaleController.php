<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Auth;

class SaleController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : null;
        $cart = app(CartController::class)->cartItemsWithTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', ['message' => "You don't have items in your cart to checkout"]);
        }

        return view('checkout.create', compact('user', 'cart'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sale $sale)
    {
        //
    }

    public function edit(Sale $sale)
    {
        //
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }
}
