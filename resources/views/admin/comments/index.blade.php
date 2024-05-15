<x-admin-layout class="Contact">
    <x-admin-header 
        header_title="Comments"
        :total_count="count($comments)"
    />

    <div class="body">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if(count($comments) > 0)
                    @php $id = 1 @endphp
                    @foreach($comments as $comment)
                        <tr class="{{ $comment->is_visible == 0 ? 'strikethrough' : '' }}">
                            <td>
                                <a href="{{ route('comments.edit', ['comment' => $comment->id]) }}">
                                    {{ $id++ }}
                                </a>
                            </td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->phone_number }}</td>
                            <td>
                                {{ Illuminate\Support\Str::limit($comment->message, 35, ' ...') }}
                            </td>
                            <td class="actions">
                                <div class="action">
                                    <form id="deleteForm_{{ $comment->id }}" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $comment->id }}, 'comment');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No comments yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>