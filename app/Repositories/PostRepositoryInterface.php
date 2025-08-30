<?php

namespace App\Repositories;
use App\Models\Post;

interface PostRepositoryInterface
{
  public function getAllPosts();
  public function storePost(array $data);
  public function deletePost(Post $post);

}
