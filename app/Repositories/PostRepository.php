<?php 

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::with(['user', 'comments.user', 'likes'])
                   ->latest()
                   ->paginate(10);
    }

    public function storePost(array $data, Request $request)
    {
        $post = new Post();
        $post->user_id = auth()->id();
        $post->content = $data['content'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        $post->refresh();

        return [
            'id' => $post->id,
            'content' => $post->content,
            'image_url' => $post->image ? asset('storage/' . $post->image) : null,
            'user_name' => $post->user->name,
            'user_profile_image' => $post->user->profile_image 
                ? asset('storage/' . $post->user->profile_image) 
                : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name),
            'created_at_human' => $post->created_at->diffForHumans(),
            'user_id' => $post->user_id,
        ];
    }


    public function deletePost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403); 
        }

        $post->delete();

        return true;
    }

}
