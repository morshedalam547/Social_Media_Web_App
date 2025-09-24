<?php

namespace App\DTOs;

class ProfileDTO
{
    //properties
    public $update_image;


    //method
    public function __construct($new_image) //user Request filed
    {
        //public class under request data.
        $this->update_image = $new_image;
    }
}
