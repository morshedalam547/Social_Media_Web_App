<?php

namespace App\Repositories;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::with(['user', 'comments.user', 'likes'])
            ->latest()
            ->paginate(3);
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

        return $newPost;
    }

    public function destroyPost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return true;
    }




}



