<x-app-layout>
@include('partials.navbar')

<main class="Cart">
    @include('partials.messages')

    <div class="container">
        <div class="header">
            <h1>Your Cart</h1>
            <p>You have {{ Session::get('cart_count', 0) }} items in your cart</p>
        </div>

        <div class="body">
            <ul class="list_style_none">
                @foreach($cart['items'] as $product)
                <li>
                    <span class="title">
                        <a href="">
                            {{ $product['title'] }}
                        </a>
                    </span>

                    <span class="price">
                        <span class="currency">Ksh. </span>
                        <span class="price_amount">{{ $product['selling_price'] }}</span>
                    </span>

                    <span class="product_quantity">
                        <form class="quantity_form" action="{{ route('change_quantity', $product['id']) }}" method="post">
                            @csrf
                            <input type="number" name="quantity" class="quantity_input" min="1" value="{{ $product['quantity'] }}">
                        </form>
                    </span>

                    <span class="subtotal">
                        <span class="currency">Ksh. </span>
                        <span class="subtotal_amount">{{ $product['quantity'] * $product['selling_price'] }}</span>
                    </span>

                    <span class="delete_from_cart">
                        <form id="deleteForm_{{ $product['id'] }}" action="{{ route('cart.destroy', $product['id']) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="button" onclick="deleteItem({{ $product['id'] }}, 'product');">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </span>
                </li>
                @endforeach
            </ul>

            <div class="summary">
                <h1>Order Summary</h1>
                <p>
                    <span>Cart Total</span>
                    <span id="cart_total">Ksh. {{ $cart['subtotal'] }}</span>
                </p>

                <div class="action">
                    <a href="{{ route('checkout.create') }}">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</main>

<x-slot name="javascript">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let quantityInputs = document.querySelectorAll('.quantity_input');
    
            quantityInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    let form = this.closest('.quantity_form');
                    let formData = new FormData(form);
    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            // If form submission is successful, refresh the page
                            location.reload();
                        } else {
                            console.error('Form submission failed:', response.status);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>
    <x-sweetalert></x-sweetalert>
</x-slot>

</x-app-layout>
