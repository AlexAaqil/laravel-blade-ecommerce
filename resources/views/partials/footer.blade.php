<footer>
    <div class="container">
        <div class="branding">
            <div class="image">
                <x-app-logo />
            </div>
            <h1>{{ env('APP_NAME') }}</h1>
            <p>Some cool slogan.</p>
        </div>

        <div class="links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>

        <div class="contacts">
            <div class="details">
                <p>{{ config('globals.phone_number') }}</p>
                <p>{{ config('globals.email') }}</p>
            </div>
        </div>
    </div>

    <p class="copyright">&copy; 2024 | All rights reserved</p>
</footer>