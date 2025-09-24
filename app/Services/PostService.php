<?php

namespace App\Services;
use App\DTOs\PostDTO;
use App\Repositories\PostRepositoryInterface;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function all()
    {
        return $this->postRepo->getAllPosts();
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
