<x-admin-layout class="Products">
    <div class="custom_form">
        <header>
            <p>Update Product</p>
        </header>

        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="product_code">Product Code</label>
                    <input type="text" name="product_code" id="product_code" placeholder="Product Code" value="{{ old('product_code', $product->product_code) }}">
                    <span class="inline_alert">{{ $errors->first('product_code') }}</span>
                </div>
                
                <div class="input_group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Product Title" value="{{ old('title', $product->title) }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
            </div>

            <div class="row_input_group_3">
                <div class="input_group">
                    <label for="is_featured">Is Featured?</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="is_featured" id="yes" value="1" {{ old('is_featured', $product->is_featured) == '1' ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>
    
                        <label>
                            <input class="option_radio" type="radio" name="is_featured" id="no" value="0" {{ old('is_featured', $product->is_featured) == '0' ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('is_featured') }}</span>
                </div>

                <div class="input_group">
                    <label for="is_visible">Is Visible?</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="is_visible" id="yes" value="1" {{ old('is_visible', $product->is_visible) == '1' ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>
    
                        <label>
                            <input class="option_radio" type="radio" name="is_visible" id="no" value="0" {{ old('is_visible', $product->is_visible) == '0' ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('is_visible') }}</span>
                </div>

                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', $product->ordering) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <div class="row_input_group">
                <div class="input_group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <span class="inline_alert">{{ $errors->first('category_id') }}</span>
                </div>

                <div class="input_group">
                    <label for="measurement_id">Measurement</label>
                    <select name="measurement_id" id="measurement_id">
                        <option value="">Select Measurement</option>
                        @foreach($measurements as $measurement)
                            <option value="{{ $measurement->id }}" {{ old('measurement_id', $product->measurement_id) == $measurement->id ? 'selected' : '' }}>{{ $measurement->value . ' ' . $measurement->unit }}</option>
                        @endforeach
                    </select>
                    <span class="inline_alert">{{ $errors->first('measurement_id') }}</span>
                </div>
            </div>

            <fieldset>
                <legend>Pricing</legend>

                <div class="row_input_group_4">
                    <div class="input_group">
                        <label for="buying_price">Buying Price</label>
                        <input type="number" name="buying_price" id="buying_price" placeholder="Buying Price" value="{{ old('buying_price', $product->buying_price) }}">
                        <span class="inline_alert">{{ $errors->first('buying_price') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" name="selling_price" id="selling_price" placeholder="Selling Price" value="{{ old('selling_price', $product->selling_price) }}">
                        <span class="inline_alert">{{ $errors->first('selling_price') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="discount_amount">Discount Amount</label>
                        <input type="number" name="discount_amount" id="discount_amount" placeholder="Discount Amount" value="{{ old('discount_amount', $product->discount_amount) }}">
                        <span class="inline_alert">{{ $errors->first('discount_amount') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="discount_percentage">Discount Percentage</label>
                        <input type="number" name="discount_percentage" id="discount_percentage" placeholder="Discount Percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}">
                        <span class="inline_alert">{{ $errors->first('discount_percentage') }}</span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Stock</legend>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="stock_count">Stock Count</label>
                        <input type="number" name="stock_count" id="stock_count" placeholder="Stock Count" value="{{ old('stock_count', $product->stock_count) }}">
                        <span class="inline_alert">{{ $errors->first('stock_count') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="safety_stock">Safety Stock</label>
                        <input type="number" name="safety_stock" id="safety_stock" placeholder="Safety Stock" value="{{ old('safety_stock', $product->safety_stock) }}">
                        <span class="inline_alert">{{ $errors->first('safety_stock') }}</span>
                    </div>
                </div>
            </fieldset>

            <div class="input_group">
                <label for="images">Images (Maximum allowed images is 5)</label>
                <input type="file" name="images[]" id="images" accept=".png, .jpg, .jpeg" multiple />
                <span class="inline_alert">{{ session('error') ? session('error') : ($errors->has('images') ? $errors->first('images') : '') }}</span>
            </div>

            @if(!empty(session('success')))
                <span class="inline_alert_success">{{ session('success')['message'] }}</span>
            @endif

            <div class="product_images" id="sortable">
                @if(!empty($product->images->count()))
                    @foreach ($product->images as $image)
                        @if(!empty($image->getProductImageUrl()))
                            <div class="product_image sortable_item" id={{ $image->id }}>
                                <img src="{{ $image->getProductImageUrl() }}" alt="{{ $image->image_name }}" />
                                <a href="{{ route('product-images.destroy', $image->id) }}" >
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <span class="faded">Product has no images</span>
                    <br><br>
                @endif
            </div>

            <div class="input_group">
                <label for="description">Product Description</label>
                <textarea name="description" id="editor_ckeditor" cols="30" rows="10" placeholder="Describe the product">{{ old('description', $product->description) }}</textarea>
                <span class="inline_alert">{{ $errors->first('description') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>

        <form action="{{ route('product-categories.store') }}" method="post">
            @csrf

            <div class="input_group">
                <label for="title">New Category Title</label>
                <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>

        <form action="{{ route('product-measurements.store') }}" method="post">
            @csrf

            <div class="row_input_group">
                <div class="input_group">
                    <label for="value">Value</label>
                    <input type="text" name="value" id="value" placeholder="Value" value="{{ old('value') }}">
                    <span class="inline_alert">{{ $errors->first('value') }}</span>
                </div>

                <div class="input_group">
                    <label for="unit">New Unit of Measurement</label>
                    <input type="text" name="unit" id="unit" placeholder="Unit of Measurement (e.g. Kg)" value="{{ old('unit') }}">
                    <span class="inline_alert">{{ $errors->first('unit') }}</span>
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-text-editor />
        <x-sortable url="{{ route('product-images.sort') }}" />
    </x-slot>
</x-admin-layout>