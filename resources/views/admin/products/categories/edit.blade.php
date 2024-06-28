<x-admin-layout class="Products">
    <div class="custom_form">
        <div class="related_pages">
            <a href="{{ route('product-categories.index') }}">View Categories</a>
        </div>

        <header>
            <p>Update</p>
        </header>

        <form action="{{ route('product-categories.update', $product_category->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="input_group">
                <label for="title">Category Title</label>
                <input type="text" name="title" id="title" placeholder="Category Title" value="{{ old('title', $product_category->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>

        <form id="deleteForm_{{ $product_category->id }}" action="{{ route('product-categories.destroy', $product_category->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p>Delete {{ $product_category->title }} category</p>
        
            <button type="button" onclick="deleteItem({{ $product_category->id }}, 'product category');" class="delete_btn">
                <i class="fas fa-trash-alt"></i>
                <span>Delete</span>
            </button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>