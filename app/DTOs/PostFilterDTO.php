<?php

namespace App\DTOs;

class PostFilterDTO
{
    public ?string $search;

    public function __construct(?string $search = null)
    {
        $this->search = $search;
    }
}
