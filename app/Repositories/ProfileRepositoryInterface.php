<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ProfileRepositoryInterface
{
    public function getUser();
    public function updateProfile(array $data);
    public function updateCover(array $data);
    public function updateProfileImage(array $data);
}
