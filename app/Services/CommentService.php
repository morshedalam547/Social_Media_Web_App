<?php

namespace App\Services;

use App\DTOs\CommentDTO;
use App\Repositories\CommentRepositoryInterface;

class CommentService
{
    public function __construct(protected CommentRepositoryInterface $commentRepo)
    {
    }

    public function createComment(CommentDTO $dto)
    {
        return $this->commentRepo->storeComment([
            'user_id' => $dto->user_id,
            'post_id' => $dto->post_id,
            'content' => $dto->content,
            'parent_id' => $dto->parent_id, // <-- add parent_id
        ]);
    }
}
