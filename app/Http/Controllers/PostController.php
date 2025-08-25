<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Repositories\PostRepositoryInterface;

use App\Models\Post;
class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $user = auth()->user();
        $posts = $this->postRepo->getAllPosts();

        return view('posts.dashboard', compact('user', 'posts'));
    }

    //New post add function
    public function store(PostStoreRequest $request)
    {

        // $post = $this->postRepo->storePost($request->validated());

        $post = $this->postRepo->storePost([
        'user_id' => auth()->id(),          
        'content' => $request->input('content'),
        'image'   => $request->file('image') ?? null,
    ]);

        $html = view('posts.post_card', compact('post'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }



    //Post Delete Function
    public function destroy(Post $post)
    {
        $this->postRepo->deletePost($post);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ]);
    }


}
