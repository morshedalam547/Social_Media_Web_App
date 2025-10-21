<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\LikeRequest;
// use App\Repositories\LikeRepositoryInterface;

// class LikeController extends Controller
// {
//     protected $likeRepo;

//     public function __construct(LikeRepositoryInterface $likeRepo)
//     {
//         $this->likeRepo = $likeRepo;
//     }

//     public function like(LikeRequest $request)
//     {
//         $result = $this->likeRepo->toggleLike([
//             'post_id' => $request->post_id,
//             'user_id' => auth()->id(),
//             'emoji_type' => $request->emoji ?? 'like',
//         ]);

//         return response()->json($result);
//     }
// }
