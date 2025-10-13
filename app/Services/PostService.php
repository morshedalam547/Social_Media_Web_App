<?php

namespace App\Services;

use App\DTOs\PostDTO;
use App\DTOs\PostFilterDTO;
use App\Repositories\PostRepositoryInterface;

class PostService
{
    protected PostRepositoryInterface $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function all(PostFilterDTO $filter)
    {
        return $this->postRepo->getAllPosts($filter);
    }

    public function createPost(PostDTO $dto)
    {
        return $this->postRepo->storePost([
            'user_id' =>  $dto->user_id,
            'content' =>  $dto->content,
            'image' =>  $dto->image,
        ]);
    }

    public function delete($post)
    {
        return $this->postRepo->destroyPost($post);
    }
}
