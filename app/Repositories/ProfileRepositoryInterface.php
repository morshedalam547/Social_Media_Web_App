<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ProfileRepositoryInterface
{
    public function getUser();
    public function updateProfile(Request $request);
    public function updateCover(Request $request);
    public function updateProfileImage(Request $request);
}
