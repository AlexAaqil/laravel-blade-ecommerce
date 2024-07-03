<x-admin-layout class="Products Product_reviews">
    <div class="container update_review">
        <div class="custom_form">
            <header>
                <p>Update Product Review</p>
                <p>
                    {{ $product_review->user->first_name . ' ' . $product_review->user->last_name }}
                </p>
                <p>
                    {{ $product_review->user->email }}
                </p>
                <p>
                    {{ $product_review->user->phone_number }}
                </p>
            </header>

            <form action="{{ route('product-reviews.update', ['product_review' => $product_review->id]) }}" method="post">
                @csrf
                @method('PATCH')

                <p class="product_details">
                    {{ $product_review->product->title }}
                </p>
                
                <p class="review">
                    {{ $product_review->review }}
                    <span class="rating">
                        <i class="fas fa-star"></i> 
                        {{ $product_review->rating }}
                    </span>
                </p>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="is_visible">Is Visible</label>
                        <div class="custom_radio_buttons">
                            <label>
                                <input class="option_radio" type="radio" name="is_visible" id="is_visible" value="1" {{ $product_review->is_visible ==1 ? 'checked' : '' }}>
                                <span>Yes</span>
                            </label>

                            <label>
                                <input class="option_radio" type="radio" name="is_visible" id="not_visible" value="0" {{ $product_review->is_visible == 0 ? 'checked' : '' }}>
                                <span>No</span>
                            </label>
                        </div>
                        <span class="inline_alert">{{ $errors->first('is_visible') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="ordering">Ordering</label>
                        <input type="number" name="ordering" id="ordering" value="{{ old('ordering', $product_review->ordering) }}" />
                        <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                    </div>
                </div>

                <button type="submit">Update</button>
            </form>

            <form id="deleteForm_{{ $product_review->id }}" action="{{ route('product-reviews.destroy', $product_review->id) }}" method="POST">
                @csrf
                @method('DELETE')
    
                <p>Delete this review?</p>
            
                <button type="button" onclick="deleteItem({{ $product_review->id }}, 'product review');" class="delete_btn">
                    <i class="fas fa-trash-alt"></i>
                    <span>Delete</span>
                </button>
            </form>
        </div>
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>
