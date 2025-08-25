<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\LikeRepositoryInterface;

class LikeController extends Controller
{
    protected $likeRepo;

    public function __construct(LikeRepositoryInterface $likeRepo)
    {
        $this->likeRepo = $likeRepo;
    }

   public function like(Post $post)
{
    $result = $this->likeRepo->toggleLike([
        'post_id' => $post->id,
        'user_id' => auth()->id(),
    ]);
    
    return response()->json($result);
}

}
