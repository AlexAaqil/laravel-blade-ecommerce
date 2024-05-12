<x-app-layout>
@include('partials.navbar')

<main class="Blog">
    <section class="Hero">
        <div class="hero_content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('users.blogs') }}">Blogs</a>
            </div>
            <h1>Shea.254 Blog</h1>
        </div>
    </section>

    <section class="Blogs">
        <div class="container">
            @if($blogs->count() > 0)
                <div class="blogs">
                    <h1>Recent Posts</h1>

                    <div class="blogs_wrapper">
                        @foreach($blogs as $blog)
                        <div class="blog">
                            <div class="image">
                                <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                                    <img src="{{ $blog->getImageUrl() }}" alt="Blog Image">
                                </a>
                            </div>
                            <div class="text">
                                <span class="date">
                                    {{ $blog->created_at->diffForHumans() }}
                                </span>
                                <span class="title">
                                    <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                                        {{ $blog->title }}
                                    </a>
                                </span>
                                <span class="content">
                                    {!! html_entity_decode(Illuminate\Support\Str::limit($blog->content, 100, ' ...')) !!}
                                </span>
                                <div class="btn">
                                    <a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($blogs->hasPages())
                        <div class="pagination">
                            @if ($blogs->previousPageUrl())
                                <span class="pagination-previous">
                                    <a href="{{ $blogs->previousPageUrl() }}">Previous</a>
                                </span>
                            @else
                                <span class="pagination-previous disabled">Previous</span>
                            @endif

                            <span class="pagination-links">
                                {{-- Display page numbers --}}
                                @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                    <a href="{{ $blogs->url($i) }}" class="{{ $blogs->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                                @endfor
                            </span>

                            @if ($blogs->nextPageUrl())
                                <span class="pagination-next">
                                    <a href="{{ $blogs->nextPageUrl() }}">Next</a>
                                </span>
                            @else
                                <span class="pagination-next disabled">Next</span>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <h1>There's no available posts yet.</h1>
            @endif
        </div>
    </section>
</main>

@include('partials.footer')
</x-app-layout>
