<x-admin-layout class="Products">
    <x-admin-header 
        header_title="Reviews" 
        :total_count="count($reviews)"
    />

    <div class="body">
        <div class="related_pages">
            <a href="{{ route('products.index') }}">Products</a>
            <span>Reviews</span>
        </div>

        @if(count($reviews) > 0)
            <ul class="list">
                @foreach($reviews as $review)
                    <li class="searchable {{ $review->is_visible == 0 ? 'strike' : '' }}">
                        <a href="{{ route('product-reviews.edit', ['product_review'=>$review->id]) }}">{{ $review->ordering }}</a>
                        <span>{{ $review->user->first_name . ' ' . $review->user->last_name }}</span>
                        <span>{{ $review->review }}</span>
                        <span><i class="fas fa-star"></i> {{ $review->rating }}</span>
                    </li>
                @endforeach
            </ul>      
        @else
            <p>No product reviews yet.</p>
        @endif
    </div>
</x-admin-layout>