<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderByDesc('is_visible')->orderBy('ordering')->orderByDesc('created_at')->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:180',
            'email' => 'required|string|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:30',
            'message' => 'required|string|max:2000',
        ]);

        Comment::create($validated);

        return redirect()->back()->with('success', ['message' => 'Your message has been sent']);
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'is_visible' => 'required|numeric',
            'ordering' => 'required|numeric',
        ]);

        $comment->update($validated);

        return redirect()->route('comments.index')->with('success', ['message' => 'Comment has been updated']);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', ['message' => 'Comment has been deleted']);
    }
}
