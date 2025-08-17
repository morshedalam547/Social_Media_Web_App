<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;   

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back();
    }
}
