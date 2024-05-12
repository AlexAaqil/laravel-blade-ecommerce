<x-app-layout>
@include('partials.navbar')

<main class="Blog">
    <section class="Blogs">
        <div class="blog blog_details">
            <div class="image">
                <img src="{{ $blog->getImageUrl() }}" alt="Blog Image">
            </div>
            <div class="container">
                <div class="text">
                    <span class="date">
                        {{ $blog->created_at->diffForHumans() }}
                    </span>
                    <h1>{{ $blog->title }}</h1>
                    <span class="content">
                        {!! html_entity_decode($blog->content) !!}
                    </span>
                    <div class="btn">
                        <a href="{{ route('users.blogs') }}"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('partials.footer')
</x-app-layout>
