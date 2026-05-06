<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('dashboard', [
            'posts' => $posts,
        ]);
    }
}
