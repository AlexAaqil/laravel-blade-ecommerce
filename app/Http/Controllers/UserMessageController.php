<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    public function index()
    {
        $user_messages = UserMessage::orderByDesc('is_visible')->orderBy('ordering')->orderByDesc('created_at')->get();

        return view('admin.user_messages.index', compact('user_messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:180',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:30',
            'message' => 'required|string|max:2000',
        ]);

        UserMessage::create($validated);

        return redirect()->back()->with('success', ['message' => 'Your message has been sent']);
    }

    public function show(UserMessage $user_message)
    {
        return view('admin.user_messages.show', compact('user_message'));
    }

    public function destroy(UserMessage $user_message)
    {
        $user_message->delete();

        return redirect()->route('user-messages.index')->with('success', ['message' => 'User Message has been deleted']);
    }
}
