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

    //add Comment
    public function store(CommentStoreRequest $request)
    {
        // $comment = $this->commentRepo->storeComment($request->validated());

         $comment = $this->commentRepo->storeComment([
            
        'post_id' => $request->input('post_id'),
        'user_id' => auth()->id(),
        'content' => $request->input('content'),
    ]);

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
