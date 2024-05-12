<x-app-layout>
@include('partials.navbar')
<main class="Categorised_Products">
    <div class="hero">
        <div class="breadcrumb">
            <a href="{{ route('shop') }}">Shop</a> / {{ $category->title }}
        </div>

        <h1>{{$category->title}}</h1>
        <p>There's <strong>{{ $products->count() }}</strong> products in the <strong>{{ $category->title }}</strong> category</p>
    </div>

    <div class="container categories">
        @foreach($categories as $category)
            <a href="{{ route('products.categorized', $category->slug) }}">{{ $category->title }}</a>
        @endforeach
    </div>

    <div class="container">
        @include('partials.messages')
        <div class="card_wrapper">
            @foreach($products as $product)
                @include('partials.product')
            @endforeach
        </div>
    </div>
</main>
</x-app-layout>
