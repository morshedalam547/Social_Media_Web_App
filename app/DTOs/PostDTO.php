<?php

namespace App\DTOs;

class PostDTO
{
    public int $user_id;
    public string $content;
    public $image; 



    
    public function __construct(int $user_id, string $content, $image = null)
    {
        $this->user_id = $user_id;
        $this->content = $content;
        $this->image   = $image;
    }
}
