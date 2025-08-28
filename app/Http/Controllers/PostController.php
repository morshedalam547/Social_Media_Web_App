<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Http\Requests\PostStoreRequest;
use App\Services\PostService;
use App\Models\Post;

class PostController extends Controller
{

    //  protected  $service;

    public function __construct(protected PostService $service)
    {

         $this->service = $service;
    }





        public function index()
    {
        $user = auth()->user();
        $posts = $this->service->getAllPosts();

        return view('posts.dashboard', compact('user', 'posts'));
    }




    // New post add function
    public function store(PostStoreRequest $request)
    {
        // Request → DTO
        $dto = new PostDTO(
            auth()->id(),
            $request->input('content'),
            $request->file('image') ?? null
        );

        // DTO → Service
        $newPost = $this->service->createPost($dto);

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
        $this->service->deletePost($post);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ]);
    }
}
