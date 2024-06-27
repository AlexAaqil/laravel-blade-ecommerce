<x-general-layout class="Home">
    <section class="Hero">
        <div class="container">
            <div class="text">
                <h1>EXCLUSIVE COLLECTION FOR EVERYONE</h1>
                <div class="hero_btn">
                    <a href="#" class="btn">Start Shopping</a>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('assets/images/hero.png') }}" alt="{{ env('APP_NAME') }} homepage hero">
            </div>
        </div>
    </section>

    <section class="Products">
        <div class="container">
            <div class="header">
                <h1>Most Trending</h1>
            </div>

            <div class="products">
                @include('partials.product')
                @include('partials.product')
                @include('partials.product')
                @include('partials.product')
                @include('partials.product')
                @include('partials.product')
            </div>
        </div>
    </section>

    <section class="Blogs">
        <div class="container">
            <h1>The Latest Blogs</h1>

            {{-- <div class="blogs">
                @include('partials.blog')
                @include('partials.blog')
                @include('partials.blog')
            </div> --}}
        </div>
    </section>
</x-general-layout>