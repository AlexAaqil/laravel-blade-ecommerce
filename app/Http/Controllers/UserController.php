<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('user_status')->orderBy('user_level')->orderBy('created_at')->get();

        return view("admin.users.index", compact("users"));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->user_level = $request->user_level;
        $user->user_status = $request->user_status;

        $user->save();

        return redirect()->route('users.index')->with('success', ['message' => 'User has been updated']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', ['message' => 'User has been deleted']);
    }
}
