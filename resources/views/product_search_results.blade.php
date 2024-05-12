<x-app-layout>
@include('partials.navbar')
<main class="Categorised_Products">
    @include('partials.messages')

    <div class="hero">
        <div class="breadcrumb">
            <a href="{{ route('shop') }}">Shop</a> / {{ $query }}
        </div>

        <h1>{{ $query }}</h1>
        <p><strong>{{ $products->count() }}</strong> products matched your query.</p>
    </div>

    <div class="product_search_results container">
        <div class="card_wrapper">
            @foreach($products as $product)
                @include('partials.product')
            @endforeach
        </div>
    </div>
</main>
</x-app-layout>
