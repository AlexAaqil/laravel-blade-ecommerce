<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $blog_categories = BlogCategory::all();

        return view('admin.blogs.create', compact('blog_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable',
            'title' => 'required|string|unique:blogs',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $blog = new Blog;

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $blog->id . '-' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/blogs/';
            $image->move(public_path($path), $filename);
            $blog->image = $path . $filename;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been added.']);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('blog_details', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $blog_categories = BlogCategory::all();

        return view('admin.blogs.edit', compact('blog_categories', 'blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'nullable',
            'title' => 'required|string|unique:blogs,title,' . $blog->id,
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        // Handle image upload and update filename if necessary
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $blog->id . '-' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/blogs/';
            $image->move(public_path($path), $filename);

            // Delete the old image file if exists
            if (File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }
            // Update the image filename
            $blog->image = $path . $filename;
        }

        // Check if the title has changed
        if ($request->title !== $blog->title) {
            // Update the slug and image filename based on the new title
            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);

            // Rename the image file if it exists
            if ($blog->image) {
                $oldImagePath = public_path($blog->image);
                $newImageFilename = $blog->id . '-' . Str::slug($request->title) . '.' . pathinfo($blog->image, PATHINFO_EXTENSION);
                $newImagePath = public_path('uploads/blogs/'.$newImageFilename);
                File::move($oldImagePath, $newImagePath);
                $blog->image = 'uploads/blogs/' .$newImageFilename;
            }
        }

        $blog->category_id = $request->category_id;
        $blog->content = $request->content;

        $blog->save();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been updated.']);
    }

    public function destroy(Blog $blog)
    {
        // Delete the blog's image if it exists
        if ($blog->image) {
            File::delete(public_path($blog->image));
        }

        // Delete the blog
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog has been deleted.']);
    }

    public function users_blogs(Blog $blog)
    {
        $blogs = Blog::latest()->paginate(6);

        return view('blogs', compact('blogs'));
    }
}
