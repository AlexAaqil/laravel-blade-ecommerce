<x-admin-layout class="Products">
    <x-admin-header 
        header_title="Measurements" 
        :total_count="count($measurements)"
    />

    <div class="body">
        <div class="related_pages">
            <a href="{{ route('products.index') }}">Products</a>
            <span>Measurements</span>
        </div>

        <form action="{{ route('product-measurements.store') }}" method="post" class="create_form">
            @csrf

            <input type="text" name="unit" id="unit" placeholder="New Measurement Unit">
            <span class="inline_alert">{{ $errors->first('unit') }}</span>

            <input type="number" name="value" id="value" placeholder="Value">
            <span class="inline_alert">{{ $errors->first('value') }}</span>

            <button type="submit">Save</button>
        </form>

        @if(count($measurements) > 0)
            <ul class="list">
                @foreach($measurements as $measurement)
                    <li class="searchable">
                        <a href="{{ route('product-measurements.edit', $measurement->id) }}" class="text_link">{{ $measurement->unit . ' ' . $measurement->value }}</a>
                    </li>
                @endforeach
            </ul>      
        @else
            <p>No product measurements yet.</p>
        @endif
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>