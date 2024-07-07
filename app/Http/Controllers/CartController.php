<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store($product)
    {
        $product = Product::find($product);

        if(!$product) {
            return redirect()->back()->with('error', ['message' => 'Product not found']);
        }  
        
        $cart = Session::get('cart', []);

        $message = 'Product has been added to cart';
        
        if(array_key_exists($product->id, $cart)) {
            // Increment the quantity if product is already in the cart
            $cart[$product->id]['quantity']++;
            $message = 'Product quantity has been increased';
        } else {
            // Initialize price with regular price
            $price = $product->selling_price;
            
            // Check if discount price is available && valid
            if ($product->discount_amount > 0 && $product->discount_amount < $product->selling_price) {
                $price = $product->selling_price  - $product->discount_amount;
            } elseif($product->discount_percentage > 0 && $product->discount_percentage < 100) {
                $discount = ($product->discount_percentage / 100) * $product->selling_price;
                $price = $product->selling_price - $discount;
            }
            
            // Add product to cart
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'buying_price' => $product->buying_price,
                'selling_price' => $price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        // Call the method to update cart count
        $this->update_cart_count();

        return redirect()->back()->with('success', ['message' => $message]);
    }

    public function update_cart_count()
    {
        $cart = Session::get('cart', []);
        $cart_count = array_sum(array_column($cart, 'quantity'));

        Session::put('cart_count', $cart_count);
    }

    public static function getProductQuantity($product)
    {
        $cart = Session::get('cart', []);
        return array_key_exists($product, $cart) ? $cart[$product]['quantity'] : 0;
    }
}
