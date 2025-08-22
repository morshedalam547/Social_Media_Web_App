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

    public function store(PostStoreRequest $request)
    {
        $validated = $request->validated();
        $post = $this->postRepo->storePost($validated, $request);

        return response()->json($post);
    }




public function destroy(Post $post)
{
    $this->postRepo->deletePost($post);

    return response()->json([
        'success' => true,
        'message' => 'Post deleted successfully.'
    ]);
}


}
