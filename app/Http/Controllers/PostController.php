<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
 public function index()
    {
        $user = auth()->user();
        $posts = Post::with(['user', 'comments.user', 'likes'])->latest()->paginate(10);

        return view('posts.dashboard', compact('user', 'posts'));
        
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
    ]);

    $post = new Post();
    $post->user_id = auth()->id();
    $post->content = $validated['content'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('post_images', 'public');
        $post->image = $imagePath;
    }

    $post->save();
    $post->refresh();


    $html = view('posts.post_card', compact('post'))->render();

    return response()->json([
        'html' => $html, 
    ]);
}

    public function commentStore(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return response()->json([
            'content' => $comment->content,
            'user_name' => $comment->user->name,
            'user_image' => $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name),
            'created_at' => $comment->created_at->diffForHumans(),
            'comments_count' => $post->comments()->count(),
        ]);
    }

    public function like(Post $post)
    {
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return response()->json(['status' => 'already_liked', 'likes_count' => $post->likes()->count()]);
        }

        $post->likes()->create(['user_id' => $user->id]);

        return response()->json(['status' => 'liked', 'likes_count' => $post->likes()->count()]);
    }
public function share(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'platform' => 'required|string'
    ]);

   

    return response()->json([
        'success' => true,
        'message' => 'Share logged successfully'
    ]);
}

public function destroy(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $post->delete();

    return response()->json([
        'success' => true,
        'message' => 'Post deleted successfully.'
    ], 200);
}


    
}
