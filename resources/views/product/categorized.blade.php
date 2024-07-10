<x-general-layout class="Products Products_categorized">
    <section class="hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('shop') }}">Shop</a> / {{ $category->title }}
            </div>
        
            <p class="title">{{$category->title}}</p>
            <p class="text">There's <strong>{{ $products->count() }}</strong> products in the <strong>{{ $category->title }}</strong> category</p>
        </div>
    </section>

    @include('product.categories')
    
    <section class="products">
        <div class="container">
            <div class="cards products_wrapper">
                @foreach($products as $product)
                    @include('product.card')
                @endforeach
            </div>
        </div>
    </section>
</x-general-layout>
    