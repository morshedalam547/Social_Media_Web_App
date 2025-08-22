<?php 

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function storeComment(array $data)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $data['post_id'],
            'content' => $data['content'],
        ]);

        $post = $comment->post; 

        return [
            'content' => $comment->content,
            'user_name' => $comment->user->name,
            'user_image' => $comment->user->profile_image 
                ? asset('storage/' . $comment->user->profile_image) 
                : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name),
            'created_at' => $comment->created_at->diffForHumans(),
            'comments_count' => $post->comments()->count(),
        ];
    }
}
