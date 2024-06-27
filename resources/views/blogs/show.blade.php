<x-general-layout class="Blogs">
    <section class="Details">
        <div class="container">
            <header>
                <h1>{{ $blog->title }}</h1>
                
                <div class="image">
                    <img src="{{ $blog->getImageUrl() }}" alt="{{ $blog->title }}" width="350" height="350">
                </div>
            </header>

            <section class="details">
                <div>{!! $blog->content !!}</div>
            </section>
        </div>
    </section>
</x-general-layout>