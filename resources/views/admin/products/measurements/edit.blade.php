<x-admin-layout class="Products">
    <div class="custom_form">
        <div class="related_pages">
            <a href="{{ route('product-measurements.index') }}">View Measurements</a>
        </div>

        <header>
            <p>Update</p>
        </header>

        <form action="{{ route('product-measurements.update', $product_measurement->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="unit">Measurement Unit</label>
                    <input type="text" name="unit" id="unit" placeholder="Measurement Unit" value="{{ old('unit', $product_measurement->unit) }}">
                    <span class="inline_alert">{{ $errors->first('unit') }}</span>
                </div>

                <div class="input_group">
                    <label for="value">Value</label>
                    <input type="number" name="value" id="value" placeholder="Value" value="{{ old('value', $product_measurement->value) }}">
                    <span class="inline_alert">{{ $errors->first('value') }}</span>
                </div>
            </div>

            <button type="submit">Update</button>
        </form>

        <form id="deleteForm_{{ $product_measurement->id }}" action="{{ route('product-measurements.destroy', $product_measurement->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p>Delete this measurement?</p>
        
            <button type="button" onclick="deleteItem({{ $product_measurement->id }}, 'product measurement');" class="delete_btn">
                <i class="fas fa-trash-alt"></i>
                <span>Delete</span>
            </button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>