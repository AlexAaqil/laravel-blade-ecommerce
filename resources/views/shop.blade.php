<x-general-layout class="Shop">
    <section class="Header">
        <div class="container">
            <form action="{{ route('products.search') }}" method="GET">
                @csrf
                
                <input type="text" name="query" id="query" placeholder="Search Product">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </section>

    @include('product.categories')

    <section class="Products">
        <div class="cards container">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="card product_card">
                        @include('product.card')
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</x-general-layout>