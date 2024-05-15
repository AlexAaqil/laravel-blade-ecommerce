<x-admin-layout class="Contact">
    <div class="custom_form edit_comment">
        <div class="header">
            <h1>Update Comment</h1>
            <p>
                <span>{{ $comment->name }}</span>
                <span>{{ $comment->email }}</span>
                <span>{{ $comment->phone_number }}</span>
            </p>
        </div>

        <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="comment">
                <p>{{ $comment->message }}</p>
            </div>
            
            <div class="row_input_group">
                <div class="input_group">
                    <label for="is_visible">Is Visible</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="is_visible" id="visible" value="1" {{ $comment->is_visible ==1 ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>
    
                        <label>
                            <input class="option_radio" type="radio" name="is_visible" id="not_visible" value="0" {{ $comment->is_visible == 0 ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('is_visible') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" value="{{ old('ordering', $comment->ordering) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>