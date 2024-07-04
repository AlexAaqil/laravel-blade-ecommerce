<x-admin-layout class="Products">
    <div class="custom_form">
        <header>
            <p>New Product</p>
        </header>

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="is_featured" id="is_featured" value="0">
            <input type="hidden" name="is_visible" id="is_visible" value="1">
            <input type="hidden" name="ordering" id="ordering" value="100">

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Product Title" value="{{ old('title') }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>

                <div class="input_group">
                    <label for="product_code">Product Code <span>(optional)</span></label>
                    <input type="text" name="product_code" id="product_code" placeholder="Product Code" value="{{ old('product_code') }}">
                    <span class="inline_alert">{{ $errors->first('product_code') }}</span>
                </div>
            </div>

            <div class="row_input_group">
                <div class="input_group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <span class="inline_alert">{{ $errors->first('category_id') }}</span>
                </div>

                <div class="input_group">
                    <label for="measurement_id">Measurement</label>
                    <select name="measurement_id" id="measurement_id">
                        <option value="">Select Measurement</option>
                        @foreach($measurements as $measurement)
                            <option value="{{ $measurement->id }}" {{ old('measurement_id') == $measurement->id ? 'selected' : '' }}>{{ $measurement->value . ' ' . $measurement->unit }}</option>
                        @endforeach
                    </select>
                    <span class="inline_alert">{{ $errors->first('measurement_id') }}</span>
                </div>
            </div>

            <fieldset>
                <legend>Pricing</legend>
                <span class="inline_alert">{{ session('discount_error') ? session('discount_error') : ($errors->has('discount') ? $errors->first('discount') : '') }}</span>

                <div class="row_input_group_4">
                    <div class="input_group">
                        <label for="buying_price">Buying Price</label>
                        <input type="number" name="buying_price" id="buying_price" placeholder="Buying Price" value="{{ old('buying_price') }}">
                        <span class="inline_alert">{{ $errors->first('buying_price') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" name="selling_price" id="selling_price" placeholder="Selling Price" value="{{ old('selling_price') }}">
                        <span class="inline_alert">{{ $errors->first('selling_price') }}</span>
                    </div>

                    <div class="input_group">
                        <label for="discount_amount">Discount Amount</label>
                        <input type="number" name="discount_amount" id="discount_amount" placeholder="Discount Amount" value="{{ old('discount_amount', 0) }}">
                        <span class="inline_alert">{{ $errors->first('discount_amount') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="discount_percentage">Discount Percentage</label>
                        <input type="number" name="discount_percentage" id="discount_percentage" placeholder="Discount Percentage" value="{{ old('discount_percentage', 0) }}">
                        <span class="inline_alert">{{ $errors->first('discount_percentage') }}</span>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Stock</legend>

                <div class="row_input_group">
                    <div class="input_group">
                        <label for="stock_count">Stock Count</label>
                        <input type="number" name="stock_count" id="stock_count" placeholder="Stock Count" value="{{ old('stock_count', 0) }}">
                        <span class="inline_alert">{{ $errors->first('stock_count') }}</span>
                    </div>
    
                    <div class="input_group">
                        <label for="safety_stock">Safety Stock</label>
                        <input type="number" name="safety_stock" id="safety_stock" placeholder="Safety Stock" value="{{ old('safety_stock', 0) }}">
                        <span class="inline_alert">{{ $errors->first('safety_stock') }}</span>
                    </div>
                </div>
            </fieldset>

            <div class="input_group">
                <label for="images">Images (Maximum allowed images is 5)</label>
                <input type="file" name="images[]" id="images" accept=".png, .jpg, .jpeg" multiple />
                <span class="inline_alert">{{ $errors->first('images') }}</span>
            </div>

            <div class="input_group">
                <label for="description">Product Description</label>
                <textarea name="description" id="editor_ckeditor" cols="30" rows="10" placeholder="Describe the product">{{ old('description') }}</textarea>
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
    </x-slot>
</x-admin-layout>