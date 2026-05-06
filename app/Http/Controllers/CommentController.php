<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => ['required', 'exists:posts,id'],
            'content' => ['required', 'string', 'max:1000'],
        ]);

        Comment::create([
            'post_id' => $data['post_id'],
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        $post = Post::findOrFail($comment->post_id);
        $isAdmin = Auth::user()?->email === 'admin@example.com';

        if (!($isAdmin || Auth::id() === $comment->user_id || Auth::id() === $post->user_id)) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
