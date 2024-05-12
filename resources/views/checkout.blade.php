<x-app-layout>
@include('partials.navbar')
<main class="Checkout Cart">
    <div class="container">
        <div class="header">
            <h1>Billing information</h1>
        </div>

        <div class="body">
            <div class="custom_form">
                <form action="" method="post">
                    @csrf

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Enter your Full Name" value="{{ $user ? $user->full_name : old('full_name') }}">
                            <span class="inline_alert">{{ $errors->first('full_name') }}</span>
                        </div>
                        <div class="input_group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="example@gmail.com" value="{{ $user ? $user->email : old('email') }}">
                            <span class="inline_alert">{{ $errors->first('email') }}</span>
                        </div>
                    </div>

                    <div class="row_input_group">
                        <div class="input_group">
                            <label for="phone_number">Phone Number <span class="details">(MPesa Number to be used for payment)</span></label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="2547xxxxxxxx" value="{{ $user ? $user->phone_number : old('phone_number') }}">
                            <span class="inline_alert">{{ $errors->first('phone_number') }}</span>
                        </div>
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
                            <input type="text" name="address" id="address" value="{{ $user ? $user->address : old('address') }}">
                            <span class="inline_alert">{{ $errors->first('address') }}</span>
                        </div>

                        <div class="row_input_group">
                            <div class="input_group">
                                <label for="location">Location</label>
                                <select name="location" id="location">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">
                                            {{ $location->location_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="inline_alert">{{ $errors->first('location') }}</span>
                            </div>

                            <div class="input_group">
                                <label for="area">Area</label>
                                <select name="area" id="area">
                                    <option value="">Select Area</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->area_name }}
                                        </option>
                                    @endforeach
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

                    <button type="submit">Confirm Order</button>
                </form>
            </div>

            <div class="summary">
                <h1>Order Summary</h1>
                <p>
                    <span>Cart Total</span>
                    <span>Ksh. {{ number_format($cart['subtotal'], 2) }}</span>
                </p>
                <p>
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
</main>
<x-slot name="javascript">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const locationSelect = document.getElementById("location");
            const areaSelect = document.getElementById("area");
            const shippingCostElement = document.getElementById("shipping_cost_amount");
            const totalElement = document.getElementById("total_amount");
            const pick_up_method = document.querySelectorAll("input[name='pickup_method']");
            const delivery_details = document.getElementById("delivery_details");
        
            function togglePickupMethod() {
                if(pick_up_method[0].checked) {
                    delivery_details.style.display = 'block';
                } else {
                    delivery_details.style.display = 'none';
                }
            }
        
            togglePickupMethod();
        
            pick_up_method.forEach(function(radio) {
                radio.addEventListener('change', togglePickupMethod);
            });
        
            // Define areaPrice as a global variable
            let areaPrice = 0;
        
            // Function to update shipping cost and total
            function updateShippingAndTotal() {
                const shippingCost = parseFloat(areaPrice); // Parse areaPrice as a float
        
                if (!isNaN(shippingCost)) {
                    const cartSubtotal = parseFloat("{{ $cart['subtotal'] }}"); // Get cart subtotal from PHP as a float
        
                    // Format shipping cost and total with two decimal places
                    const formattedShippingCost = shippingCost.toFixed(2);
                    const formattedTotal = (shippingCost + cartSubtotal).toFixed(2);
        
                    // Update the DOM with formatted values
                    shippingCostElement.textContent = `Ksh. ${formattedShippingCost}`;
                    totalElement.textContent = `Ksh. ${formattedTotal}`;
                } else {
                    console.error("Invalid shipping cost:", areaPrice);
                }
            }
        
            locationSelect.addEventListener("change", function () {
                const selectedLocationId = this.value;
        
                // Make an Ajax request to fetch areas based on the selected location
                fetch(`/areas/fetch/${selectedLocationId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear and update the areas select box
                        areaSelect.innerHTML = "";
                        areaSelect.add(new Option("Select Area", ""));
        
                        data.forEach(area => {
                            areaSelect.add(new Option(area.area_name, area.id));
                        });
                    });
            });
        
            areaSelect.addEventListener("change", function () {
                const selectedAreaId = this.value;
        
                // Make an Ajax request to fetch the selected area's price
                fetch(`/area/shipping-price/${selectedAreaId}`)
                    .then(response => response.json())
                    .then(data => {
                        areaPrice = data.price; // Update the global areaPrice variable
        
                        // Trigger update with the area's price
                        updateShippingAndTotal();
                    });
            });
        });
        </script>
</x-slot>
</x-app-layout>
