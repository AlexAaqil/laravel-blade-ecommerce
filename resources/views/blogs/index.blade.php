<x-general-layout class="Blogs">
    <section class="Hero">
        <div class="container">
            <h1>Blogs</h1>

            <div class="categories_wrapper">
                <p class="title">Filters</p>
                <div class="categories">
                    @foreach($categories as $category)
                        @if(count($category->blogs) > 0)
                            <div class="category">
                                <span><a href="">{{ $category->title }}</a></span>
                                <span>.</span>
                                <span>{{ count($category->blogs) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="blogs">
        <div class="container">
            @if(count($blogs) > 0)
                <div class="cards">
                    @foreach($blogs as $blog)
                        <div class="card">
                            <div class="image">
                                <img src="{{ $blog->getImageUrl() }}" alt="{{ $blog->title }}" width="300" height="300">
                            </div>

                            <div class="text">
                                <div class="extra_details">
                                    <span class="faded">{{ $blog->category->title }}</span>
                                </div>

                                <div class="details">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="title">{{ $blog->title }}</a>
                                    <span class="content">{!! Illuminate\Support\Str::limit($blog->content, 65, '...') !!}</span>
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
            @else
                <p>No blogs yet.</p>
            @endif
        </div>
    </section>
</x-general-layout>