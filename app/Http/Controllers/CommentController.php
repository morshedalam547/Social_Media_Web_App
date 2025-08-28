<?php

namespace App\Http\Controllers;

use App\DTOs\CommentDTO;
use App\Http\Requests\CommentStoreRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(private CommentService $service) {}

    public function store(CommentStoreRequest $request)
    {
        // Request → DTO
        $dto = new CommentDTO(
            auth()->id(),
            $request->input('post_id'),
            $request->input('content')
        );

        // DTO → Service → Repository → DB
        $comment = $this->service->createComment($dto);

        return response()->json($comment);
    }
}
