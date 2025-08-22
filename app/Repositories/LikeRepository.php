<?php

namespace App\Repositories;

use App\Models\Post;

class LikeRepository implements \App\Repositories\LikeRepositoryInterface
{
    public function toggleLike(Post $post)
    {
        $user = auth()->user();

        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // User already liked → unlike
            $like->delete();
            return [
                'status' => 'unliked',
                'likes_count' => $post->likes()->count(),
            ];
        }

        // User hasn't liked yet → create like
        $post->likes()->create(['user_id' => $user->id]);
        return [
            'status' => 'liked',
            'likes_count' => $post->likes()->count(),
        ];
    }
}
