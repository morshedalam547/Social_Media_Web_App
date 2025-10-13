<?php

namespace App\Repositories;

use App\Models\Post;
use App\DTOs\PostFilterDTO;

interface PostRepositoryInterface
{
    public function getAllPosts(PostFilterDTO $filter);
    public function storePost(array $data);
    public function destroyPost(Post $post);
}
