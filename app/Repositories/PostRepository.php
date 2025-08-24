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
    $newPost = new Post([
        'user_id' => auth()->id(),
        'content' => $data['content'],
    ]);

    if (!empty($data['image'])) {
        $newPost->image = $data['image']->store('post_images', 'public');
    }

    $newPost->save();

    return $newPost->load(['user','comments.user','likes']);
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
