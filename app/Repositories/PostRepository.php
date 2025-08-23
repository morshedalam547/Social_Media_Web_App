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


    $post->load(['user', 'comments.user', 'likes']);

    return $post; 
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
