<aside>
    <div class="brand">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo">
            <h1>{{ env('APP_NAME') }}</h1>
        </a>
    </div>

    <ul class="links">
        @php
            $navLinks = [
                ['route' => 'admin.dashboard', 'icon' => 'fas fa-home', 'text' => 'Dashboard'],
                ['route' => 'users.index', 'icon' => 'fas fa-users', 'text' => 'Users'],
                ['route' => 'comments.index', 'icon' => 'fas fa-comment', 'text' => 'Comments'],
            ];
        @endphp

        @foreach($navLinks as $link)
            <li class="link {{ Route::currentRouteName() === $link['route'] ? 'active' : '' }}">
                <a href="{{ $link['route'] ? route($link['route']) : '#' }}">
                    <i class="{{ $link['icon'] }}"></i>
                    <span class="text">{{ $link['text'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="footer">
        <div class="profile">
            <a href="{{ route('profile.edit') }}">
                <img src="{{ asset('assets/images/default_profile.jpg') }}" alt="Profile Image">
            </a>
            <span class="text">
                <a href="{{ route('profile.edit') }}">
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                </a>
                <span>{{ Auth::user()->email }}</span>
            </span>
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="post">
                @csrf

                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="text">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>