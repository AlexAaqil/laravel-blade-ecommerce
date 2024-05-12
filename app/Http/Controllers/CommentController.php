<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        
        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|string|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Comment::create($validatedData);

        return redirect()->back()->with('success',['message' => 'Your message has been sent.']);
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', ['message' => 'Comment has been deleted.']);
    }
}
