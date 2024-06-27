<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMessage;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index()
    {
        $user_level = Auth()->user()->user_level;
        
        if($user_level == 1)
        {
            return redirect()->route('dashboard');
        }
        else if($user_level == 0)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function admin_dashboard()
    {
        $count_users = User::count();
        $count_user_messages = UserMessage::count();
        $count_blogs = Blog::count();

        return view('admin.dashboard', compact(
            'count_users',
            'count_user_messages',
            'count_blogs',
        ));
    }
}
