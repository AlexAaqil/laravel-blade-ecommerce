<nav>
    <div class="brand">
        <a href="{{ route('home') }}">
            <span>{{ env('APP_NAME') }}</span>
        </a>
    </div>

    <div class="nav_links">
        @php
            $nav_links = [
                ['route' => 'shop', 'text' => 'Shop'],
                ['route' => 'about', 'text' => 'About'],
                ['route' => 'users.blogs', 'text' => 'Blogs'],
                ['route' => 'contact', 'text' => 'Contact'],
            ];
        @endphp

        @if(Auth::user() && Auth::user()->user_level == 1)
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @elseif(Auth::user() && Auth::user()->user_level == 0)
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endif

        @foreach($nav_links as $nav_link)
            <a href="{{ $nav_link['route'] ? route($nav_link['route']) : '#' }}" class="nav_link {{ Route::currentRouteName() === $nav_link['route'] ? 'active' : '' }}">
                {{ $nav_link['text'] }}
            </a>
        @endforeach
    </div>

    <div class="extra_links">
        <div class="links">
            <div class="shopping_cart">
                <a href="#"> {{-- route('cart.index') --}}
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ session('cart_count', 0) }}</span>
                </a>
            </div>

            @if(Auth::user())
                <a href="{{ route('profile.edit') }}" class="profile">
                    <i class="fa fa-user"></i>
                </a>

                <form action="{{ route('logout') }}" method="post">
                    @csrf

                    <button type="submit" class="btn btn_logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn login_btn">Login</a>
            @endif
        </div>
    </div>

    <div class="burger_menu">
        <div class="burger_icon" id="burgerIcon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>