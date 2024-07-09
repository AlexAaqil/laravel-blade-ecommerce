<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->cartItemsWithTotals();
        return view('cart', compact('cart'));
    }

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

    public function update(Request $request, $product)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $cart = Session::get('cart', []);

        foreach($cart as &$item){
            if($item['id'] == $product){
                // Update quantity of the matching product
                $item['quantity'] = $request->input('quantity');
                // Update the total price of the product
                $item['total'] = $item['selling_price'] * $item['quantity'];
                break;
            }
        }

        Session::put('cart', $cart);
        $this->update_cart_count();

        return redirect()->route('cart.index')->with('success', ['message' => 'Quantity has been updated']);
    }

    public function destroy($product_id)
    {
        $cart = Session::get('cart', []);

        // Check if the product is in the cart
        if (array_key_exists($product_id, $cart)) {
            // Remove the product from the cart
            unset($cart[$product_id]);

            // Update the session with the modified cart
            Session::put('cart', $cart);

            // Recalculate cart count
            $this->update_cart_count();

            return redirect()->route('cart.index')->with('success', ['message' => 'Product has been removed from the cart']);
        }

        return redirect()->route('cart.index')->with('error', ['message' => 'Product not found in the cart']);
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

    public function cartItemsWithTotals()
    {
        /*
        *
        * this function returns an array structure like:

        [
            'items' => [
                $product_id_1 => [
                    'id' => 1,
                    'title' => product_title,
                    'slug' => product-title,
                    'quantity' => 3,
                    'price' => 150
                    'total' => 450,
                ],
                $product_id_2 => [
                    'id' => 2,
                    'title' => product_title,
                    'slug' => product-title,
                    'quantity' => 3,
                    'price' => 100
                    'total' => 300,
                ],
            ],
            'subtotal' => 750
        ]

        *
        */

        // Initialize an empty cart and the subtotal to zero
        $cart = ['items' => []];
        $subtotal = 0;

        /*
        * Loop through each item in cart that's stored in the session.
        * Calculate the total price of the item
        * Update the subtotal with the total price of the current item
        * Add the item to the cart
        * Add the calculated subtotal to the cart
        * Return the updated cart with calculated totals
        */
        // dd(Session::get('cart', []));
        foreach (Session::get('cart', []) as $product_id => $item) {
            $price = $item['selling_price'];

            $item['total'] = $price * $item['quantity'];
            $subtotal += $item['total'];
            $cart['items'][$product_id] = $item;
        }

        $cart['subtotal'] = $subtotal;

        return $cart;
    }
}
