<footer>
    <div class="container">
        <div class="branding">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="rounded">
            <h1>{{ config('app.name') }}</h1>
            <p class="slogan">Suppliers of Raw Shea, Body butter, Cocoa Butter, Black Soap, Essential & Carrier Oils</p>
            <p class="location">Nairobi CBD <br> Sasa Mall, Moi Avenue <br> Shop G20</p>
        </div>

        <div class="links">
            <h1>Explore</h1>
            <ul class="list_style_none">
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contacts</a></li>
            </ul>
        </div>

        <div class="contacts">
            <h1>Contacts</h1>
            <div class="enquiries">
                <p>+254 711 894 267</p>
                <p>info@shea254.com</p>
            </div>
            <div class="socials">
                <a href="https://wa.me/254711894267" target="_blank"
                    >
                        <img src="{{ asset('assets/images/whatsapp.png') }}" alt="Whats App">
                </a>

                <a href="https://www.instagram.com/shea.254" target="_blank"
                    >
                    <img src="{{ asset('assets/images/instagram.png') }}" alt="Instagram">
                </a>

                <a href="https://www.facebook.com/profile.php?id=100056436834853" target="_blank">
                    <img src="{{ asset('assets/images/facebook.png') }}" alt="Facebook">
                </a>

                <a
                    href="https://www.tiktok.com/@shea.254?_t=8gJ9b2q8TP4&_r=1"
                    target="_blank"
                    >
                    <img src="{{ asset('assets/images/tiktok.png') }}" alt="Tiktok">
                </a>
            </div>
        </div>
    </div>
    <p class="copyright">&copy; 2024 | Shea254 | All rights reserved</p>
</footer>
