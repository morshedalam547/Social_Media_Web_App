<?php

namespace App\Repositories;

use App\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike(array $data)
{
    $post = Post::findOrFail($data['post_id']);

    $like = $post->likes()->where('user_id', $data['user_id'])->first();

    if ($like) {
        $like->delete();
        $status = 'unliked';
    } else {
        $post->likes()->create([
            'user_id' => $data['user_id'],
        ]);
        $status = 'liked';
    }

    // Return status + total likes
    return [
        'status' => $status,
        'likes_count' => $post->likes()->count()
    ];
}

}
