<?php

namespace App\Http\Controllers;

use App\DTOs\CommentDTO;
use App\Http\Requests\CommentStoreRequest;
use App\Services\CommentService;


class CommentController extends Controller
{
    public function __construct(protected CommentService $service) {

        $this->service = $service;
    }

    public function store(CommentStoreRequest $request, $post){
        // DTO Make
        $dto = new CommentDTO(
            auth()->id(),
            $post,
            $request->input('content')
        );

        // Service -> Repository -> DB
        $userComment = $this->service->createComment($dto);

        // Blade partial render
        $html = view('comments.comment_card',compact('userComment'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'comments_count' => $userComment->post->comments()->count(),
        ]);
    }

}