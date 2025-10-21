<?php

// namespace App\Repositories;

// use App\Models\Post;

// class LikeRepository implements LikeRepositoryInterface
// {
//     public function toggleLike(array $data)
//     {
//         $post = Post::findOrFail($data['post_id']);

//         $like = $post->likes()->where('user_id', $data['user_id'])->first();

//         if ($like && $like->emoji_type === $data['emoji_type']) {
//             // একই emoji হলে unlike করবে
//             $like->delete();
//             $status = 'unliked';
//         } else {
//             // নতুন emoji বা like create/update
//             $post->likes()->updateOrCreate(
//                 ['user_id' => $data['user_id']],
//                 ['emoji_type' => $data['emoji_type']]
//             );
//             $status = 'liked';
//         }

//         return [
//             'status' => $status,
//             'likes_count' => $post->likes()->count(),
//             'emoji_type' => $data['emoji_type']
//         ];
//     }
// }
