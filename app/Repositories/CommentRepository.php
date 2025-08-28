<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
   public function storeComment(array $data)
{
    $comment = new Comment($data);
    $comment->save();
    $comment = $comment->fresh()->load('user');

    return [
        'id' => $comment->id,
        'content' => $comment->content,
        'created_at' => $comment->created_at->diffForHumans(), // ✅ সুন্দর সময়
        'user_name' => $comment->user->name,
        'user_image' => $comment->user->profile_image 
            ? asset('storage/' . $comment->user->profile_image) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name),
    ];
}

}
