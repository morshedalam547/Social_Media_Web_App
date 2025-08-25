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

public function storePost(array $data)
{
    // Post object create

    // $newPost = new Post([
    //     'user_id' => auth()->id(),
    //     'content' => $data['content'],
    // ]);

    $newPost = new Post($data);
 
    // Image thakle upload kora
    if (!empty($data['image'])) {
        $newPost->image = $data['image']->store('post_images', 'public');
    }

    // Database e save kora
      $newPost->save();

    return $newPost->fresh();
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
