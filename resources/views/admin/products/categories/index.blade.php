<x-admin-layout class="Products">
    <x-admin-header 
        header_title="Categories" 
        :total_count="count($categories)"
    />

    <div class="body">
        <div class="related_pages">
            <a href="{{ route('products.index') }}">Products</a>
            <span>Categories</span>
        </div>

        <form action="{{ route('product-categories.store') }}" method="post" class="create_form">
            @csrf

            <input type="text" name="title" id="title" placeholder="New Categoy Title">

            <button type="submit">Save</button>
        </form>

        @if(count($categories) > 0)
            <ul class="list">
                @foreach($categories as $category)
                    <li class="searchable">
                        <a href="{{ route('product-categories.edit', $category->id) }}" class="text_link">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>      
        @else
            <p>No product categories yet.</p>
        @endif
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>