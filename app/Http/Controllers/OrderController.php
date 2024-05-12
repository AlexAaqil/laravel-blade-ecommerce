<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DeliveryLocation;
use App\Models\DeliveryArea;
use App\Models\Sale;
use App\Models\OrderDelivery;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Sale::with(['order_delivery', 'order_items'])->orderBy('id', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : null;
        $locations = DeliveryLocation::all();
        $areas = DeliveryArea::all();
        $cart = app(CartController::class)->cartItemsWithTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', ['message' => "You don't have any items in your cart to checkout."]);
        }

        return view('checkout', compact('user', 'locations', 'areas', 'cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:40',
        ]);

        $phone_number = $validated['phone_number'];
        $email = $validated['email'];

        $cart = app(CartController::class)->cartItemsWithTotals();
        $cart_items = $cart['items'];
        $cart_subtotal = $cart['subtotal'];

        $pickup_method = $request->input('pickup_method');

        // Initialize variables
        $address = '';
        $additional_information = '';

        // Set values based on the selected pickup method
        if($pickup_method === 'delivery') {
            $validated += $request->validate([
                'address' => 'required|string',
                'additional_information' => 'nullable|string',
                'location' => 'required|exists:delivery_locations,id',
                'area' => 'required|exists:delivery_areas,id',
            ]);

            $address = $validated['address'];
            $additional_information = $validated['additional_information'];
            $location = $validated['location'];
            $area = $validated['area'];

            // Get the area and location names
            $area = DeliveryArea::findOrFail($validated['area']);
            $location = DeliveryLocation::findOrFail($validated['location']);

            $area_name = $area->area_name;
            $location_name = $location->location_name;

            // Calculate the shipping cost and total amount based on selected delivery area
            $area_price = $area->price;
            $shipping_cost = $area_price;
        } else {
            $address = 'Shop';
            $additional_information = null;
            $area_name = 'Shop';
            $location_name = 'Shop';
            $shipping_cost = 0;
        }

        $total_amount = $shipping_cost + $cart_subtotal;

        // Generate order number and set user ID
        $order_number = 'ord_' . date('ymd') . Str::random(4);
        $order_type = 1;
        $discount_code = null;
        $discount = 0;
        $payment_method = null;
        $user_id = Auth::check() ? Auth::user()->id : null;

        $res = app(MpesaController::class)->stkPush($phone_number, $total_amount, $order_number, $email);

        if($res == 0 ) {
            // Create the order
            $order = Sale::create([
                'order_number' => $order_number,
                'order_type' => $order_type,
                'discount_code' => $discount_code,
                'discount' => $discount,
                'total_amount' => $total_amount,
                'payment_method' => $payment_method,
                'user_id' => $user_id,
            ]);

            $order_delivery = new OrderDelivery();
            $order_delivery->order_id = $order->id;
            $order_delivery->full_name = $validated['full_name'];
            $order_delivery->email = $email;
            $order_delivery->phone_number = $phone_number;
            $order_delivery->address = $address;
            $order_delivery->additional_information = $additional_information;
            $order_delivery->location = $location_name;
            $order_delivery->area = $area_name;
            $order_delivery->shipping_cost = $shipping_cost;
            $order_delivery->save();

            foreach($cart_items as $productId => $item) {
                $order_item = new OrderItems();
                $order_item->product_id = $item['id'];
                $order_item->title = $item['title'];
                $order_item->quantity = $item['quantity'];
                $order_item->buying_price = $item['buying_price'];
                $order_item->selling_price = $item['selling_price'];
                $order_item->order_id = $order->id;
                $order_item->save();
            }

            // Store order number in session
            Session::put('order_number', $order->order_number);

            Session::forget(['cart', 'cart_count']);

            return redirect()->route('order_success');
        } else {
            return redirect()->route('checkout.create')->with('error', ['message' => 'something went wrong']);
        }
    }

    public function edit(Sale $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Sale $order)
    {
        $validated = $request->validate([
            'additional_information' => 'nullable|string',
            'delivery_status' => 'required',
        ]);

        $order->order_delivery->additional_information = $validated['additional_information'];
        $order->order_delivery->delivery_status = $validated['delivery_status'];
        $order->order_delivery->save();

        return redirect()->route('orders.index')->with('success', ['message' => 'Order has been updated']);
    }

    public function destroy(Sale $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', ['message' => 'Order has been deleted']);
    }

    public function order_success()
    {
        $order_number = session('order_number');
        return view('order_success', compact('order_number'));
    }

    public function get_areas($locationId)
    {
        $areas = DeliveryArea::where('delivery_location_id', $locationId)->get();
        return response()->json($areas);
    }

    public function get_shipping_price($areaId)
    {
        $area = DeliveryArea::findOrFail($areaId);
        $price = $area->price;

        return response()->json(['price' => $price]);
    }
}
