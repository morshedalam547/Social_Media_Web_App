<?php

namespace App\Services;
use App\DTOs\ProfileDTO;
use App\Repositories\ProfileRepositoryInterface;

class UpdateService
{
    public function __construct(protected ProfileRepositoryInterface $profileRepo)
    {

        $this->profileRepo = $profileRepo;
    }

    public function createProfile(profileDTO $image)
    {

        return $this->profileRepo->updateProfileImage([

            'profile_image' => $image->update_image,
        ]);
    }
}