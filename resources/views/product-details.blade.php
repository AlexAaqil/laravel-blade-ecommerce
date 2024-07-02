<x-general-layout class="Product_details">
    <section class="details_wrapper">
        <div class="container">
            <div class="images">
                <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}" class="main_image">

                <div class="other_images">
                    @foreach($product->images as $image)
                        <img src="{{ asset('/storage/product_images/' . $image->image) }}" alt="{{ $product->title }}" width="200" height="200">
                    @endforeach
                </div>
            </div>

            <div class="text">
                <h1>{{ $product->title }}</h1>

                <p class="price">
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
                </p>

                <div class="forms">
                    <form action="" method="POST">
                        @csrf
    
                        <button type="submit">
                            <i class="fas fa-cart-plus"></i>
                            <span>Add to Cart</span>
                        </button>
                    </form>

                    <a href="#" class="btn">Review Product</a>
                </div>

                <div class="extras">
                    <p>
                        <span>Rating</span>
                        <span>{{ $product->average_rating() > 0 ? $product->average_rating() . ' / 5' : '0 / 5' }}</span>
                    </p>
                    <p>
                        <span>Category</span>
                        <span>{{ $product->category ? $product->category->title : 'no category' }}</span>
                    </p>
                    <p>
                        <span>Stock Count</span>
                        <span>{{ $product->stock_count == 0 ? 'out of stock' : 'in stock (' . $product->stock_count . ')' }}</span>
                    </p>
                    <p>
                        <span>Product Code</span>
                        <span>{{ $product->product_code ? $product->product_code : 'product code is unknown' }}</span>
                    </p>
                </div>

                <div class="description">
                    {!! Illuminate\Support\Str::limit($product->description, 650) !!}
                </div>
            </div>
        </div>
    </section>

    <section class="related_products">
        <div class="container">
            <h2>Related Products</h2>
            <div class="cards">
                @foreach($related_products as $product)
                    @include('partials.product')
                @endforeach
            </div>
        </div>
    </section>
</x-general-layout>