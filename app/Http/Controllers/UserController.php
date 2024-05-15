<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('user_level')->orderByDesc('created_at')->get();

        return view("admin.users.index", compact("users"));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', ['message' => 'User has been deleted']);
    }
}
