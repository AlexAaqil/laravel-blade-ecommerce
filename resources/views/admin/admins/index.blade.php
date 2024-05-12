<x-admin>
    <section class="container admins">
        @include('admin.partials.users_navbar')

        <div class="header">
            <h1>Admins <span>({{ $admins->count() }})</span></h1>
            @include('partials.js_search')
        </div>

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
                    @foreach($admins as $admin)
                    <tr class="searchable">
                        <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td>{{ $admin->user_level === 1? 'Admin':'User' }} </td>
                        <td class="{{ $admin->user_status == 1 ? '' : 'text-danger bold' }}">{{ $admin->user_status == 1? 'Active':'Inactive' }} </td>
                        <td class="actions">
                            <div class="action">
                                <a href="{{ route('admin.edit', ['admin' => $admin->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-admin>
