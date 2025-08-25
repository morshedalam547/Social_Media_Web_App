<?php

namespace App\Repositories;

use App\Models\Post;

interface LikeRepositoryInterface
{
    public function toggleLike(array $data);
}
