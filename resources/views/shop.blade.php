<x-app-layout>
    @include('partials.navbar')
    
    <main class="Shop">
        @include('partials.messages')

        <div class="search">
            <form action="{{ route('products.search') }}" method="GET">
                @csrf
                <input type="text" name="query" id="query" placeholder="Search Product">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <div class="container categories">
            @foreach($product_categories as $category)
                <a href="{{ route('products.categorized', $category->slug) }}">{{ $category->title }}</a>
            @endforeach
        </div>

        <section class="shop_products">
            <div class="container">
                <div class="card_wrapper">
                    @foreach($products as $product)
                        @include('partials.product')
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')
</x-app-layout>