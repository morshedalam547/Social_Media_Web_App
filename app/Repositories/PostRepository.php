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




public function storePost(array $data)
{
    // 1. নতুন Post model বানানো হলো array দিয়ে
    $newPost = new Post($data);

    // 2. যদি image থাকে → upload করে model এর image field এ সেট করা হচ্ছে
    if (!empty($data['image'])) {
        $newPost->image = $data['image']->store('post_images', 'public');
    }

    // 3. এখন এই Post model টাকে DB তে save করা হলো
    $newPost->save();

    // 4. fresh() মানে DB থেকে নতুন করে Model টা রিলোড করা
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