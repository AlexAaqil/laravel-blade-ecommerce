<x-admin-layout class="Contact">
    <x-admin-header 
        header_title="User Messages"
        :total_count="count($user_messages)"
    />

    <div class="body">
        <table class="table">
            <thead>
                <tr>
                    <th class="center">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if(count($user_messages) > 0)
                    @php $id = 1 @endphp
                    @foreach($user_messages as $user_message)
                        <tr class="searchable">
                            <td class="center">
                                <a href="{{ route('user-messages.show', ['user_message' => $user_message->id]) }}">
                                    {{ $id++ }}
                                </a>
                            </td>
                            <td>{{ $user_message->name }}</td>
                            <td>{{ $user_message->email }}</td>
                            <td>
                                {{ Illuminate\Support\Str::limit($user_message->message, 80, ' ...') }}
                            </td>
                            <td>{{ formatted_date($user_message->created_at) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No user messages yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-admin-layout>