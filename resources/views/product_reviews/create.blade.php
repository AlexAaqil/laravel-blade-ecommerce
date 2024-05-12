<x-app-layout>
    @include('partials.navbar')

    <main class="Product_details">
        @include('partials.messages')

        <div class="container product_review_form">
            <div class="product">
                <h1>Product Review</h1>
                <p>{{ $product->title }}</p>
                <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}">
                <p class="rating">
                    <span>Rating : </span>
                    @if($product->product_reviews->isNotEmpty())
                        </span>
                            {{ number_format($product->product_reviews->avg('rating'), 1) }} / 5
                        <span>
                    @else
                        <span>No ratings yet</span>
                    @endif
                </p>
            </div>

            <div class="custom_form">
                <form action="{{ route('product-reviews.store', ['product' => $product->id]) }}" method="post">
                    @csrf

                    <div class="input_group">
                        <label for="rating">Rating out of 5</label>
                        <div class="rating"> 
                            <input type="radio" name="rating" value="5" id="5" {{ old('rating') == '5' ? 'checked' : '' }}>
                            <label for="5">☆</label> 
                            
                            <input type="radio" name="rating" value="4" id="4" {{ old('rating') == '4' ? 'checked' : '' }}>
                            <label for="4">☆</label> 
                            
                            <input type="radio" name="rating" value="3" id="3" {{ old('rating') == '3' ? 'checked' : '' }}>
                            <label for="3">☆</label> 
                            
                            <input type="radio" name="rating" value="2" id="2" {{ old('rating') == '2' ? 'checked' : '' }}>
                            <label for="2">☆</label> 
                            
                            <input type="radio" name="rating" value="1" id="1" {{ old('rating') == '1' ? 'checked' : '' }}>
                            <label for="1">☆</label>
                        </div>
                        <span class="inline_alert">{{ $errors->first('rating') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" cols="30" rows="7" placeholder="Your thoughts about this product">{{ old('review') }}</textarea>
                        <span class="inline_alert">{{ $errors->first('review') }}</span>
                    </div>

                    {{-- <div class="input_group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
                    </div> --}}

                    <button type="submit">Send Review</button>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>