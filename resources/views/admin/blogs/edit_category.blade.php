<x-admin-layout class="Blogs">
    <div class="custom_form">
        <header>
            <p>Update Blog Category</p>
        </header>

        <form action="{{ route('blog-categories.update', $blog_category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="input_group">
                <label for="title">Blog Title</label>
                <input type="text" name="title" id="title" placeholder="Enter your Blog's Title" value="{{ old('title', $blog_category->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>

        <form id="deleteForm_{{ $blog_category->id }}" action="{{ route('blog-categories.destroy', $blog_category->id) }}" method="post">
            @csrf
            @method('DELETE')

            <p>Delete this Blog Category</p>
            <button type="button" class="delete_btn" onclick="deleteItem({{ $blog_category->id }}, 'blog category');">
                <i class="fas fa-trash-alt delete"></i>
                <span>Delete</span>
            </button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>
