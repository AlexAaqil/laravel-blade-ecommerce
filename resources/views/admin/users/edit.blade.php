<x-admin-layout class="Users">
    <div class="custom_form">
        <header>
            <p>Update User</p>
            <p>
                <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                <span>{{ $user->email }}</span>
                <span>{{ $user->phone_number }}</span>
            </p>
        </header>

        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="user_status">Status</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="user_status" id="user_status" value="1" {{ ($user->user_status == 1) ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>

                        <label>
                            <input class="option_radio" type="radio" name="user_status" id="status_0" value="0" {{ ($user->user_status == 0) ? 'checked' : '' }}>
                            <span>Inactive</span>
                        </label>
                    </div>
                </div>

                <div class="input_group">
                    <label for="user_level">User Level</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="user_level" id="user_level_1" value="1" {{ ($user->user_level == 1) ? 'checked' : '' }}>
                            <span>Admin</span>
                        </label>

                        <label>
                            <input class="option_radio" type="radio" name="user_level" id="user_level_2" value="2" {{ ($user->user_level == 2) ? 'checked' : '' }}>
                            <span>User</span>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit">Update</button>
        </form>

        <form id="deleteForm_{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="button" class="delete_btn" onclick="deleteItem({{ $user->id }}, 'user');">
                <i class="fas fa-trash-alt delete"></i>
                <span>Delete</span>
            </button>
        </form>
    </div>

    <x-slot name="javascript">
        <x-sweetalert />
    </x-slot>
</x-admin-layout>
