<x-admin-layout class="Blogs">
    <div class="custom_form">
        <header>
            <p>New Blog</p>
        </header>

        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="ordering" id="ordering" value="200">

            <div class="row_input_group">
                <div class="input_group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" />
                    <span class="inline_alert">{{ $errors->first('image') }}</span>
                </div>

                <div class="input_group">
                    <label for="is_published">Publish?</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="is_published" id="yes" value="1" {{ old('is_published', 1) == '1' ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>

                        <label>
                            <input class="option_radio" type="radio" name="is_published" id="no" value="0" {{ old('is_published') == '0' ? 'checked' : '' }}>
                            <span>Save as draft</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('is_published') }}</span>
                </div>
            </div>

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Blog Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter your Blog's Title" value="{{ old('title') }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>

                <div class="input_group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="">Select Blog Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="input_group">
                <label for="content">Blog Content</label>
                <textarea name="content" id="editor_ckeditor" cols="30" rows="10" placehoder="Enter the blog content">{{ old('content') }}</textarea>
                <span class="inline_alert">{{ $errors->first('content') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>

        <form action="{{ route('blog-categories.store') }}" method="post">
            @csrf

            <div class="input_group">
                <label for="title">New Blog Category Title</label>
                <input type="text" name="title" id="title" placeholder="New Blog Category" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-text-editor />
    </x-slot>
</x-admin-layout>
