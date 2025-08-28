<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository implements PostRepositoryInterface
{

    public function getAllPosts()
    {
        return Post::with(['user', 'comments.user', 'likes'])
            ->latest()
            ->paginate(10);
    }

//New Post Create
public function storePost(array $data)
{
    //New post Model make array base
    $newPost = new Post($data);

    if (!empty($data['image'])) {
        $newPost->image = $data['image']->store('post_images', 'public');
    }

    $newPost->save();

    return $newPost->fresh();
}

    public function deletePost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return true;
    }


    

}





// public function storePost(array $data)
// {
//     // Post object create

//     $newPost = new Post([
//         'user_id' => auth()->id(),
//         'content' => $data['content'],
//     ]);

 
//     // Image thakle upload kora
//     if (!empty($data['image'])) {
//         $newPost->image = $data['image']->store('post_images', 'public');
//     }