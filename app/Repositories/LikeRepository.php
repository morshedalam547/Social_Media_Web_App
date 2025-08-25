<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike(array $data)
    {
        $post = Post::find($data['post_id']);
        $userId = $data['user_id'];

        if (!$post) {
            return ['status' => 'error', 'message' => 'Post not found'];
        }

        $like = $post->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return [
                'status' => 'unliked',
                'likes_count' => $post->likes()->count(),
            ];
        }

        $post->likes()->create(['user_id' => $userId]);

        return [
            'status' => 'liked',
            'likes_count' => $post->likes()->count(),
        ];
    }
}
