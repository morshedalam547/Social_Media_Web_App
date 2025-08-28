<?php

namespace App\Services;

use App\DTOs\CommentDTO;
use App\Repositories\CommentRepositoryInterface;

class CommentService
{
    public function __construct(protected CommentRepositoryInterface $commentRepo) {

        $this->commentRepo = $commentRepo;
    }

    public function createComment(CommentDTO $dto)
    {
        // Repository থেকে comment create
        return $this->commentRepo->storeComment([
            'user_id' => $dto->user_id,
            'post_id' => $dto->post_id,
            'content' => $dto->content,
        ]);
    }
}

