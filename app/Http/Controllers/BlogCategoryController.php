<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:blog_categories',
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        BlogCategory::create($validated);

        return redirect()->back()->with('success', ['message' => 'Blog category has been created.']);
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blogs.edit_category', compact('blog_category'));
    }


    public function update(Request $request, BlogCategory $blog_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:80|unique:blog_categories,title,' . $blog_category->id,
        ]);

        $validated['title'] = Str::lower($validated['title']);
        $validated['slug'] = Str::slug($validated['title']);

        $blog_category->update($validated);

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog category has been updated.']);
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();

        return redirect()->route('blogs.index')->with('success', ['message' => 'Blog category has been deleted.']);
    }
}
