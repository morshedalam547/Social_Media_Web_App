<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'content', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
