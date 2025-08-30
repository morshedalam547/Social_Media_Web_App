<?php

namespace App\Http\Controllers;
use App\Http\Requests\LikeRequest;
use App\Repositories\LikeRepositoryInterface;

class LikeController extends Controller
{
    /**
     * Inject LikeRepository dependency
     */
    protected $likeRepo;

    public function __construct(LikeRepositoryInterface $likeRepo)
    {
        $this->likeRepo = $likeRepo;
    }

    // Toggle like/unlike for a post
    public function like(LikeRequest $request)
    {
        $result = $this->likeRepo->toggleLike([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        // Return JSON response (for AJAX)
        return response()->json($result);
    }
}

