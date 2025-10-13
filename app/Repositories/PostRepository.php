<?php

namespace App\Repositories;

use App\Models\Post;
use App\DTOs\PostFilterDTO;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts(PostFilterDTO $filter)
    {
        $query = Post::with(['user', 'comments.user', 'likes'])->latest();

        if ($filter->search) {
            $query->where('content', 'like', "%{$filter->search}%")
                  ->orWhereHas('user', function ($q) use ($filter) {
                      $q->where('name', 'like', "%{$filter->search}%");
                  });
        }

        return $query->paginate(15);
    }

    public function storePost(array $data)
    {
        $newPost = new Post($data);

        if (!empty($data['image'])) {
            $newPost->image = $data['image']->store('post_images', 'public');
        }

        $newPost->save();
        return $newPost;
    }

    public function destroyPost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();
        return true;
    }
}
