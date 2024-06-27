<x-admin-layout class="Blogs">
    <x-admin-header 
        header_title="Blogs" 
        :total_count="count($blogs)"
        route="{{ route('blogs.create') }}"
    />

    <div class="body">
        <div class="blog_categories">
            @if(count($categories))
                @foreach($categories as $category)
                    <span><a href="{{ route('blog-categories.edit', $category->id) }}">{{ $category->title }}</a></span>
                @endforeach
            @else
                <span>No available blog categories</span>
            @endif
        </div>

        @if(count($blogs) > 0)
            <div class="cards" id="sortable">
                @foreach($blogs as $blog)
                    <div class="card searchable sortable_item" id="{{ $blog->id }}">
                        <div class="image">
                            <img src="{{ $blog->getImageUrl() }}" alt="{{ $blog->title }}" width="300" height="300">
                        </div>

                        <div class="text">
                            <div class="extra_details">
                                <span>{{ $blog->category ? $blog->category->title : 'no category' }}</span>
                                <span class="{{ $blog->is_published == 1 ? 'published' : 'draft' }}">{{ $blog->is_published == 1 ? 'published' : 'draft' }}</span>
                                <span>{{ $blog->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="details">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="title">{!! Illuminate\Support\Str::limit($blog->title, 65, ' ...') !!}</a>
                                <span class="content">{!! Illuminate\Support\Str::limit($blog->content, 35, ' ...') !!}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No available blogs.</p>
        @endif
    </div>

    <x-slot name="javascript">
        <x-sortable url="{{ route('blogs.sort') }}" />
    </x-slot>
</x-admin-layout>