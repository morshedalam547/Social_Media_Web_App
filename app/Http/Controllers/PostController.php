<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\DTOs\PostDTO;
use App\DTOs\PostFilterDTO;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $filter = new PostFilterDTO($request->input('search'));
        $posts = $this->postService->all($filter);
        $user = auth()->user();

        return view('posts.dashboard', compact('posts', 'user'));
    }

  //New post add function
    public function store(PostStoreRequest $request)
    {
        // object Request → DTO
        $newDto = new PostDTO(
            auth()->id(),
            $request->input('content'),
            $request->file('image') ?? null
        );

        // DTO → Service
        $newPost = $this->postService->createPost($newDto);

        $html = view('posts.post_card', compact('newPost'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'message' => 'Post created Successfully',
        ]);
    }

    // Post Delete Function
    public function destroy(Post $post)
    {
        $this->postService->delete($post);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ]);
    }
}
