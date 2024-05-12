<x-admin>
    <div class="container orders">
        <div class="custom_form order_details_form">
            <h1>Update Order</h1>
            <div class="order_details">
                <div class="details">
                    <p class="text-success">
                        <span>Order_number</span>
                        <span>{{ $order->order_number }}</span>
                    </p>
                    <p>
                        <span>Names</span>
                        <span>{{ $order->order_delivery->full_name }}</span>
                    </p>
                    <p>
                        <span>Email Address</span>
                        <span>{{ $order->order_delivery->email }}</span>
                    </p>
                    <p>
                        <span>Phone Number</span>
                        <span>{{ $order->order_delivery->phone_number }}</span>
                    </p>
                    <p>
                        <span>Address</span>
                        <span>{{ $order->order_delivery->address }}</span>
                    </p>
                    <p>
                        <span>Location</span>
                        <span>{{ $order->order_delivery->location }}</span>
                    </p>
                    <p>
                        <span>Area</span>
                        <span>{{ $order->order_delivery->area }}</span>
                    </p>
                    <p>
                        <span>Order Date</span>
                        <span>{{ $order->created_at->format('M d Y \a\t h:i A') }}</span>
                    </p>
                </div>

                <div class="cart_items">
                    <p class="bold">Items Ordered</p>

                    <ul>
                        @foreach($order->order_items as $product)
                        <li>
                            <span>{{ $product['title'] }}</span>
                            <span>{{ $product['quantity'] }} @ {{ $product['selling_price'] }}</span>
                            <span>= Ksh. {{ number_format($product['selling_price'] * $product['quantity'], 2) }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <p>
                        <span>Shipping Cost : </span>
                        <span>Ksh. {{ $order->order_delivery->shipping_cost }}</span>
                    </p>
                    <p class="text-success bold">
                        <span>Total Amount : </span>
                        <span>Ksh. {{ number_format($order->total_amount, 2) }}</span>
                    </p>
                </div>
            </div>
            <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="additional_information">Additional Information</label>
                        <input type="text" name="additional_information" id="additional_information" placeholder="Extra Information... (e.g) Specific Location" value="{{ $order ? $order->order_delivery->additional_information : old('additional_information') }}">
                        <span class="inline_alert">{{ $errors->first('additional_information') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="delivery_status">Delivery Status</label>
                        <select name="delivery_status" id="delivery_status">
                            <option value="" {{ !$order || $order->order_delivery->delivery_status == '' ? 'selected' : ''}}>Select Order Status</option>
                            <option value="pending" {{ ($order && $order->order_delivery->delivery_status == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="processed" {{ ($order && $order->order_delivery->delivery_status == 'processed') ? 'selected' : '' }}>Processed</option>
                        </select>
                        <span class="inline_alert">{{ $errors->first('delivery_status') }}</span>
                    </div>
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-admin>
