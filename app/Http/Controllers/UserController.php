<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function admins()
    {
        $admins = User::getAdmins();
        return view('admin.admins.index', compact('admins'));
    }

    public function edit_admin(User $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update_admin(Request $request, User $admin)
    {
        $admin->user_level = $request->user_level;
        $admin->user_status = $request->user_status;

        $admin->save();

        return redirect()->route('admin.admins')->with('success', ['message' => 'Admin has been updated.']);
    }

    public function users()
    {
        $users = User::getUsers();
        return view('admin.users.index', compact('users'));
    }

    public function edit_user(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update_user(Request $request, User $user)
    {
        $user->user_level = $request->user_level;
        $user->user_status = $request->user_status;

        $user->save();

        return redirect()->route('admin.users')->with('success', ['message' => 'User has been updated.']);
    }
}
