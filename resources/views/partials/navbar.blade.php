<nav>
    <div class="nav_container">
        <a href="{{ route('home') }}" class="branding">
            <img src="{{ asset('/assets/images/logo.jpg') }}" width=30 height=30 alt="Logo" class="rounded">
            <h1>{{ config('app.name') }}</h1>
        </a>


        <div class="nav_links" id="navLinks">
            <ul class="list_style_none">
                @if(Auth::user() && Auth::user()->user_level == 2)
                    <li>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @elseif(Auth::user() && Auth::user()->user_level == 1)
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @endif
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('users.blogs') }}">Blog</a></li>
                <li class="cart">
                    <a href="{{ route('cart.index') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span>{{ count((array) session('cart')) }}</span>
                    </a>
                </li>
                <li class="nav_authentication">
                    @if(Auth::user())
                        <a href="{{ route('profile.edit') }}" class="profile">
                            <i class="fa fa-user"></i>
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit logout">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endif
                </li>
            </ul>
        </div>

        <div class="burger_menu">
            <div class="burger_icon" id="burgerIcon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</nav>
