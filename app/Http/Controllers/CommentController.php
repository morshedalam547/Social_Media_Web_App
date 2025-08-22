<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Repositories\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function store(CommentStoreRequest $request)
    {
        $validated = $request->validated();
        $comment = $this->commentRepo->storeComment($validated);

        return response()->json($comment);
    }



    // public function destroy(Comment $comment)
    // {
    //     if ($comment->user_id !== auth()->id()) {
    //         abort(403);
    //     }

    //     $comment->delete();

    //     return back();
    // }
}
