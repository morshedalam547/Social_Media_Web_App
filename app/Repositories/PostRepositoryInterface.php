<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Post;
interface PostRepositoryInterface
{
    public function getAllPosts();
  public function storePost(array $data); // এখানে Request আর নাই
      public function deletePost(Post $post); // ✅ add delete method
}
