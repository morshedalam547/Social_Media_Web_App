<?php

namespace App\Repositories;


interface ProfileRepositoryInterface
{
    public function getUser();
    public function updateProfile(array $data);
    public function updateCover(array $data);
    public function updateProfileImage(array $data);
}
