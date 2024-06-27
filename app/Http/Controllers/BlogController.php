<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('ordering')->orderByDesc('created_at')->get();
        $categories = BlogCategory::orderBy('title')->get();
        
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::select('id', 'title')->orderBy('title')->get();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs',
            'content' => 'required|string',
            'ordering' => 'required|numeric',
            'is_published' => 'required|boolean',
            'category_id' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $blog = new Blog;

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->ordering = $request->ordering;
        $blog->is_published = $request->is_published;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::slug($request->title) . '-' . env('APP_NAME') . '.' . $image->getClientOriginalExtension();
            $image = $image->storeAs('blog_images', $filename, 'public');
            $blog->image = $filename;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been added.']);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::select('id', 'title')->orderBy('title')->get();

        return view('admin.blogs.edit', compact('categories', 'blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs,title,' . $blog->id,
            'content' => 'required|string',
            'ordering' => 'numeric',
            'is_published' => 'required|boolean',
            'category_id' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        // Handle image upload and update filename if necessary
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($blog->image) {
                Storage::delete('public/blog_images/' . $blog->image);
            }

            // Upload the new image
            $image = $request->file('image');
            $filename = Str::slug($request->title) . '-' . env('APP_NAME') . '.' . $image->getClientOriginalExtension();
            $image = $image->storeAs('blog_images', $filename, 'public');
            $blog->image = $filename;
        }

        // Check if the title has changed and update slug if necessary
        if ($request->title !== $blog->title) {
            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
    
            // Rename the image file based on the updated title if it exists
            if ($blog->image) {
                $oldFilename = $blog->image;
                $newFilename = Str::slug($request->title) . '-' . env('APP_NAME') . '.' . pathinfo($oldFilename, PATHINFO_EXTENSION);
    
                // Rename the file in storage
                Storage::move('public/blog_images/' . $oldFilename, 'public/blog_images/' . $newFilename);
    
                // Update the blog image to the new filename
                $blog->image = $newFilename;
            }
        }

        $blog->is_published = $request->is_published;
        $blog->category_id = $request->category_id;
        $blog->ordering = $request->ordering;
        $blog->content = $request->content;

        $blog->save();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been updated.']);
    }

    public function destroy(Blog $blog)
    {
        // Delete the blog's image if it exists
        if ($blog->image) {
            Storage::delete('public/blog_images/' . $blog->image);
        }

        // Delete the blog
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been deleted.']);
    }

    public function users_blogs(Blog $blog)
    {
        $blogs = Blog::where('is_published', 1)->orderBy('ordering')->paginate(6);
        $categories = BlogCategory::orderBy('title')->get();

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function sort_blogs(Request $request)
    {
        return $this->sort_items($request, Blog::class);
    }
}
