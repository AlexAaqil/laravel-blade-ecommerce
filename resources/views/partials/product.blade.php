<div class="card product_card">
    <div class="image">
        <a href="{{ route('products.show', $product->slug) }}">
            <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}">
        </a>

        @if($discount = $product->calculate_discount())
            @if($discount['discount_percentage'] > 0)
                <span class="percentage_discount">
                    {{ round($discount['discount_percentage']) }}% off
                </span>
            @endif
        @endif

        @if($product->stock_count > 0)
        <div class="actions">
            <div class="action">
                <form action="" method="POST">
                    @csrf

                    <button type="submit" title="Add to Cart">
                        {{-- Add to cart --}}
                        <i class="fa fa-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>

    <div class="text">
        <div class="extra_details">
            @if($product->category)
                <span>{{ $product->category->title }}</span>
            @endif
            
            @if($product->stock_count == 0)
                <span class="danger">sold out</span>
            @endif
        </div>
        
        <div class="details">
            <div class="info">
                <a href="{{ route('products.show', $product->slug) }}" class="title">{{ $product->title }}</a>

                <div class="price_rating">
                    @if($discount = $product->calculate_discount())
                        @if($discount['discount_percentage'] > 0)
                            <span class="price">
                                <span class="new_price">Ksh. {{ $discount['discount_amount'] }}</span>
                                <span class="old_price">{{ $product->selling_price }}</span>
                            </span>
                        @else
                            <span class="price">
                                <span class="new_price">Ksh. {{ $product->selling_price }}</span>
                            </span>
                        @endif
                    @endif

                    @if($product->reviews->count() > 0)
                        <span class="rating">
                            <span><i class="fas fa-star"></i> {{ number_format($product->average_rating(), 1) }} ({{ $product->product_reviews->count() }} reviews)</span>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>