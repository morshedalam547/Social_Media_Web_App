<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function storeComment(array $data): Comment
    {
        $comment = Comment::create($data);

        return $comment->fresh();
    }
}
