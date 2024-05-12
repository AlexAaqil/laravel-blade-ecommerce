<div class="card product_card">
    <div class="image">
        <a href="{{ route('products.details', ['slug' => $product->slug]) }}" class="title">
            <img src="{{ $product->getFirstImage() }}" alt="Product">
        </a>
    </div>

    <div class="text">
        <div class="extra_details">
            @if($product->product_category)
                <span>
                    <a href="{{ route('products.categorized', $product->product_category->slug) }}">
                        {{ $product->product_category->title }}
                    </a>
                </span>
            @endif
        </div>
        
        <div class="content">
            <div class="details">
                <span class="title">
                    <a href="{{ route('products.details', ['slug' => $product->slug]) }}">
                        {{ $product->title }}
                    </a>
                </span>
                <span class="content">
                    @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
                        <span class="price">
                            <span class="amount">Ksh. {{ $product->discount_price }}</span>
                            <span class="discount_price">
                                <del>{{ $product->selling_price }}</del>
                            </span>
                            <span class="discount_percentage">
                                {{ round($product->calculateDiscount()) }}% off
                            </span>
                        </span>
                    @else
                        <span class="price">
                            <span class="currency">Ksh.</span>
                            <span class="price_amount">{{ $product->selling_price }}</span>
                        </span>
                    @endif
                </span>
            </div>

            <div class="actions">
                <div class="action">
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                        @csrf

                        <button type="submit">
                            <i class="fa fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>