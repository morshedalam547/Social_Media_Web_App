<?php

namespace App\DTOs;

class PostDTO
{
    //properties
    public int $user_id;
    public string $content;
    public string $z;
    public $image;




    //method
    public function __construct($id_user, $new_content, $new_image) //user Request filed
    {
        //public class under request data.

        $this->user_id = $id_user;
        $this->content = $new_content;
        $this->image = $new_image;
    }
}
