<?php

namespace App\DTOs;

class CommentDTO
{
    public int $user_id;
    public int $post_id;
    public string $content;

    public function __construct(int $user_id, int $post_id, string $content)
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->content = $content;
    }
}
