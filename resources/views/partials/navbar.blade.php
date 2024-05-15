<nav>
    <div class="brand">
        <a href="{{ route('home') }}">
            <h1>{{ env('APP_NAME') }}</h1>
        </a>
    </div>

    <div class="nav_links">
        @php
            $nav_links = [
                ['route' => 'about', 'text' => 'About'],
                ['route' => 'shop', 'text' => 'Shop'],
                ['route' => 'contact', 'text' => 'Contact'],
            ];
        @endphp

        @if(Auth::user() && Auth::user()->user_level == 1)
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @elseif(Auth::user() && Auth::user()->user_level == 2)
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endif

        @foreach($nav_links as $nav_link)
            <a href="{{ $nav_link['route'] ? route($nav_link['route']) : '#' }}" class="nav_link {{ Route::currentRouteName() === $nav_link['route'] ? 'active' : '' }}">
                {{ $nav_link['text'] }}
            </a>
        @endforeach
    </div>

    <div class="nav_authentication">
        @if(Auth::user())
            <div class="actions">
                <a href="{{ route('profile.edit') }}" class="profile">
                    <i class="fa fa-user"></i>
                </a>
    
                <form action="{{ route('logout') }}" method="post">
                    @csrf
    
                    <button type="submit" class="logout_btn">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="login_btn">Login</a>
        @endif
    </div>

    <div class="burger_menu">
        <div class="burger_icon" id="burgerIcon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>