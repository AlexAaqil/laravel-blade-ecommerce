<x-general-layout class="Shop">
    <section class="Header">
        <div class="container">
            <input type="text" name="search" id="search" placeholder="Search Products">
        </div>
    </section>

    <section class="Categories">
        <div class="container">
            @if(count($categories) > 0)
                <a href="#">All</a>
                @foreach($categories as $category)
                    <a href="#">{{ $category->title }}</a>
                @endforeach
            @else
                <span>No categories available</span>
            @endif
        </div>
    </section>

    <section class="Products">
        <div class="cards container">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="card product_card">
                        @include('partials.product')
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</x-general-layout>