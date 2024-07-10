@if(count($categories) > 0)
<section class="Categories">
    <div class="container">
        <a href="{{ route('shop') }}">All</a>
        @foreach($categories as $category)
            <a href="{{ route('products.categorized', $category->slug) }}">{{ $category->title }}</a>
        @endforeach
    </div>
</section>
@endif