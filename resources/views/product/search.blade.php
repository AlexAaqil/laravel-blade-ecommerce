<x-general-layout class="Products">
    <section class="hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('shop') }}">Shop</a> / {{ $query }}
            </div>
    
            <p class="title">{{ $query }}</p>
            <p class="text"><strong>{{ $products->count() }}</strong> products matched your query</p>
        </div>
    </section>

    <section class="product_search_results">
        <div class="container cards">
            @foreach($products as $product)
                @include('product.card')
            @endforeach
        </div>
    </section>
</x-general-layout>
    