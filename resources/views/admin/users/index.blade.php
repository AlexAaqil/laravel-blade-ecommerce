<x-admin>
    <div class="container users">
        @include('admin.partials.users_navbar')
        
        <div class="header">
            <h1>Users <span>({{ $users->count() }})</span></h1>
            @include('partials.js_search')
        </div>

        @include('partials.messages')

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>User Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="searchable">
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->user_level == 1 ? 'Admin':'User' }}</td>
                        <td class="{{ $user->user_status == 1 ? '' : 'text-danger bold' }}">{{ $user->user_status == 1 ? 'Active' : 'Inactive'}} </td>
                        <td class="actions">
                            <div class="action">
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
