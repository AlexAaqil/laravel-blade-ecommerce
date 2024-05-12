<x-admin-layout class="Dashboard">
    <div class="hero">
        <h1>Hi {{ Auth::user()->first_name }}</h1>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="text">
                <a href="{{ route('users.index') }}">Users</a>
                <span>{{ $count_users }}</span>
            </div>
        </div>

        <div class="stat">
            <div class="icon">
                <i class="fas fa-comment"></i>
            </div>
            <div class="text">
                <a href="">Comments</a>
                <span>{{ $count_comments }}</span>
            </div>
        </div>
    </div>
</x-admin-layout>