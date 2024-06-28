<x-admin-layout class="Products">
    <x-admin-header 
        header_title="Products" 
        :total_count="count($products)"
        route="{{ route('products.create') }}"
    />

    <div class="body">
        <div class="related_pages">
            <a href="">Reviews ({{ $reviews }})</a>
            <a href="{{ route('product-categories.index') }}">Categories ({{ $categories }})</a>
            <a href="{{ route('product-measurements.index') }}">Measurements ({{ $measurements }})</a>
        </div>

        @if(count($products) > 0)
            <div class="cards products_wrapper">
                @foreach($products as $product)
                <div class="card product_card searchable">
                    <div class="image">
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                            <img src="{{ $product->getFirstImage() }}" alt="Product">
                        </a>

                        @if($discount = $product->calculate_discount())
                            @if($discount['discount_percentage'] > 0)
                                <span class="percentage_discount">
                                    {{ round($discount['discount_percentage']) }}% off
                                </span>
                            @endif
                        @endif

                        <div class="actions">
                            <form id="deleteForm_{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="deleteItem({{ $product->id }}, 'product');">
                                    <i class="fas fa-trash-alt danger"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text">
                        <div class="extra_details">
                            @if($product->product_code)
                                <span>{{ $product->product_code }}</span>
                            @endif
                            <span>{{ $product->category ? $product->category->title : 'no category' }}</span>
                            <span class="{{ $product->stock_count == 0 ? 'danger' : 'success' }}">
                                {{ $product->stock_count == 0 ? 'out of stock' : 'in stock (' . $product->stock_count . ')' }}
                            </span>
                            <span class="{{ $product->featured == 1 ? 'success' : 'danger'}}">
                                {{ $product->featured == 1 ? 'featured' : 'not featured'}}
                            </span>
                        </div>
                        
                        <div class="details">
                            <div class="info">
                                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="title">
                                    {{ $product->title }}
                                </a>

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
                @endforeach
            </div>      
        @else
            <p>No products yet.</p>
        @endif
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>