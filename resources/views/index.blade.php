<x-app-layout>
    @include('partials.navbar')

    <main class="Homepage">
        @include('partials.messages')

        <section class="Hero">
            <div class="categories">
                
                <div class="category">
                    <a href="{{ route('products.categorized', $product='raw-shea-butter') }}">
                        <h1>Raw</h1>
                        <h1>Shea</h1>
                    </a>
                </div>
                
                <div class="category">
                    <a href="{{ route('products.categorized', $product='raw-cocoa-butter') }}">
                        <h1>Raw</h1>
                        <h1>Cocoa</h1>
                    </a>
                </div>
                
                <div class="category">
                    <a href="{{ route('products.categorized', $product='whipped-shea-cocoa') }}">
                        <h1>Shea</h1>
                        <h1>& Cocoa</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('products.categorized', $product='black-soap') }}">
                        <h1>Black</h1>
                        <h1>Soap</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('products.categorized', $product='essential-oil') }}">
                        <h1>Essential</h1>
                        <h1>Oils</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('products.categorized', $product='carrier-oil') }}">
                        <h1>Carrier</h1>
                        <h1>Oils</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('products.categorized', $product='scrub') }}">
                        <h1>Scrubs</h1>
                    </a>
                </div>
    
                <div class="category">
                    <a href="{{ route('products.categorized', $product='serum') }}">
                        <h1>Serums</h1>
                    </a>
                </div>
            </div>
    
            <div class="hero_text">
                <div class="slideshow">
                    <img src="{{ asset('/assets/images/shea254-1.jpg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-2.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-3.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-4.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-5.png') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-6.jpeg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-7.jpeg') }}" alt="Hero Image">
                    <img src="{{ asset('/assets/images/shea254-8.jpeg') }}" alt="Hero Image">
                </div>
    
                <div class="brand">
                    <div class="image">
                        <img src="{{ asset('/assets/images/hero-logo.png') }}" alt="Hero Logo">
                    </div>
                    <h1>Shea.254</h1>
                    <p>Skin Care Experts</p>
                </div>
            </div>
        </section>
    
        <section class="Products">
            <div class="container">
                <div class="header">
                    <h1>Most Popular</h1>
                    <a href="{{ route('shop') }}">Shop all</a>
                </div>
    
                <div class="card_wrapper">
                    @foreach($featured_products as $product)
                        @include('partials.product')
                    @endforeach
                </div>
            </div>
        </section>

        @if($testimonials->count() > 2)
        <section class="Testimonials">
            <div class="container">
                <div class="header">
                    <h1>Testimonials</h1>
                </div>

                <div class="testimonials">
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial">
                            <p>{{ $testimonial->review }}</p>
                            <p class="details">
                                <span>
                                    {{ $testimonial->user->first_name . ' ' . $testimonial->user->last_name }}</span>
                                <span>{{ $testimonial->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('partials.footer')

    <x-slot name="javascript">
        <x-jquery>
            <script>
                $(document).ready(function() {
                    var currentSlide = 0;
                    var slides = $('.hero_text .slideshow img');

                    function showSlide(index) {
                        slides.removeClass('active');
                        slides.eq(index).addClass('active');
                    }

                    function nextSlide() {
                        currentSlide = (currentSlide + 1) % slides.length;
                        showSlide(currentSlide);
                    }

                    // Show the first slide initially
                    showSlide(currentSlide);

                    // Set interval to switch slides every 5 seconds
                    setInterval(nextSlide, 5000);
                });
            </script>
        </x-jquery>
    </x-slot>
</x-app-layout>