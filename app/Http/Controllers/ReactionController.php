<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Post;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
public function react(Request $request, $postId)
{
    $reaction = $request->reaction;

    $existing = Reaction::where('post_id', $postId)
        ->where('user_id', auth()->id())
        ->first();

    if($existing){
        $existing->update(['type' => $reaction]);
    } else {
        Reaction::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'type' => $reaction
        ]);
    }

    $count = Reaction::where('post_id', $postId)->count();

    return response()->json(['likes_count' => $count]);
}
}
