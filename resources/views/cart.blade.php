<x-general-layout class="Cart">
    <div class="container">
        <div class="header">
            <h1>Your Cart</h1>
            <p>You have {{ Session::get('cart_count', 0) }} items in your cart</p>
        </div>
        
        @if(Session::get('cart_count') > 0)
            <div class="body">
                <div class="cart_items">
                    @foreach($cart['items'] as $product)
                        <div class="cart_item">
                            <span class="title">
                                <a href="{{ route('products.show', $product['slug']) }}">
                                    {{ $product['title'] }}
                                </a>
                            </span>

                            <span class="price">{{ $product['selling_price'] }}</span>

                            <span class="quantity">
                                <form method="post" action="{{ route('cart.update', ['product' => $product['id']]) }}"  class="quantity_form">
                                    @csrf

                                    <span>x</span>
                                    <input type="number" name="quantity" class="quantity_input" min="1" value="{{ $product['quantity'] }}">
                                </form>
                            </span>

                            <span class="subtotal">
                                <span>=</span>
                                {{ $product['quantity'] * $product['selling_price'] }}
                            </span>

                            <span class="delete_item">
                                <form id="deleteForm_{{ $product['id'] }}" action="{{ route('cart.destroy', $product['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
        
                                    <button type="button" onclick="deleteItem({{ $product['id'] }}, 'product');">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="order_summary">
                    <p class="title">Order Summary</p>
                    <p class="details">
                        <span>Cart Total</span>
                        <span id="cart_total">Ksh. {{ $cart['subtotal'] }}</span>
                    </p>

                    <div class="action">
                        <a href="{{ route('checkout.create') }}" class="btn">Checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="no_cart_items">
                <a href="{{ route('shop') }}" class="btn">Start Shopping</a>    
            </div>
        @endif
    </div>
    
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
</x-general-layout>
    