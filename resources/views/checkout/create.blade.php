<x-general-layout class="Products">
    <section class="Checkout">
        <div class="container">
            <div class="order_details">
                <p class="title">Billing information</p>
                <div class="custom_form">
                    <form method="post" action="">
                        @csrf

                        <div class="user_details">
                            <p>
                                <span>Name</span>
                                <span>{{ $user->first_name . ' ' . $user->last_name ?? 'unknown' }}</span>
                            </p>
    
                            <p>
                                <span>Email</span>
                                <span>{{ $user->email ?? 'unknown' }}</span>
                            </p>
    
                            <p>
                                <span>Phone</span>
                                <span>{{ $user->phone_number ?? 'unknown' }}</span>
                            </p>
                        </div>

                        <div class="input_group">
                            <label for="status">How Would you like to receive your Order?</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="pickup_method" id="delivery" value="delivery" checked>
                                    <span>Delivery</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="pickup_method" id="shop" value="shop">
                                    <span>Pick it from the shop</span>
                                </label>
                            </div>
                        </div>

                        <div class="delivery_details" id="delivery_details">
                            <div class="input_group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" value="{{ $user ? $user->address : old('address') }}" placeholder="Enter the address your order should be delivered to">
                                <span class="inline_alert">{{ $errors->first('address') }}</span>
                            </div>

                            <div class="row_input_group">
                                <div class="input_group">
                                    <label for="location">Location</label>
                                    <select name="location" id="location">
                                        <option value="">Select Location</option>
                                        {{-- @foreach($locations as $location)
                                            <option value="{{ $location->id }}">
                                                {{ $location->location_name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                    <span class="inline_alert">{{ $errors->first('location') }}</span>
                                </div>

                                <div class="input_group">
                                    <label for="area">Area</label>
                                    <select name="area" id="area">
                                        <option value="">Select Area</option>
                                        {{-- @foreach($areas as $area)
                                            <option value="{{ $area->id }}">
                                                {{ $area->area_name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                    <span class="inline_alert">{{ $errors->first('area') }}</span>
                                </div>
                            </div>   

                            <div class="input_group">
                                <label for="additional_information">Additional Information</label>
                                <input type="text" name="additional_information" id="additional_information" placeholder="Extra Information about the order... (e.g) Specific Location" value="{{ $user ? $user->additional_information : old('additional_information') }}">
                                <span class="inline_alert">{{ $errors->first('additional_information') }}</span>
                            </div>
                        </div>

                        <div class="input_group">
                            <label for="status">Choose your preffered payment method</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="payment_method" id="delivery" value="63902" checked>
                                    <span>Mpesa</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="payment_method" id="airtel_money" value="63903">
                                    <span>Airtel Money</span>
                                </label>

                                <label>
                                    <input class="option_radio" type="radio" name="payment_method" id="t_kash" value="63907">
                                    <span>T-Kash</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit">Confirm Order</button>
                    </form>
                </div>
            </div>

            <div class="summary">
                <div class="order_summary">
                    <p class="title">Order Summary</p>

                    <p class="details">
                        <span>Cart Total</span>
                        <span>Ksh. {{ number_format($cart['subtotal'], 2) }}</span>
                    </p>
                    <p class="details">
                        <span>Shipping Cost</span>
                        <span id="shipping_cost_amount">0</span>
                    </p>

                    <p class="total">
                        <span>Total</span>
                        <span id="total_amount">Ksh. {{ number_format($cart['subtotal'], 2) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-general-layout>
    