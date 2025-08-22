<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface CommentRepositoryInterface
{
    public function storeComment(array $data);
}
