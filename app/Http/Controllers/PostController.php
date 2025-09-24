<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\DTOs\PostDTO;
use App\Services\PostService;
use App\Http\Requests\PostStoreRequest;
use App\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    /*
     ! Inject PostService into controller
     */

    public function __construct(protected PostService $service)
    {

        $this->service = $service;
    }

    // Show dashboard with all posts

    /* 
    ! PostRepositoryInterface only one method injection index function under...
     */

    // public function index(PostRepositoryInterface $postRepo)
    // {
    //     $user = auth()->user();
    //     $posts = $postRepo->getAllPosts();

    //     return view('posts.dashboard', compact('user', 'posts'));

    // }

    public function index()
    {
        $user = auth()->user();
        $posts = $this->service->all();

        return view('posts.dashboard', compact('user', 'posts'));
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
        $newPost = $this->service->createPost($newDto);

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
        $this->service->delete($post);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ]);
    }
}
