<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getUser()
    {
        $user = Auth::user();
        $user->load([
            'posts' => function ($query) {
                $query->with(['likes', 'comments.user'])->latest();
            }
        ]);
        return $user;
    }

    public function updateProfile(array $data)
    {
        $user = Auth::user();

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        // Profile image update
        if (!empty($data['profile_image'])) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $user->profile_image = $data['profile_image']->store('profile_images', 'public');
        }

        $user->save();
        return $user->fresh();
    }

    public function updateCover(array $data)
    {
        $user = Auth::user();

        if (!empty($data['cover_image'])) {
            if ($user->cover_image) {
                Storage::disk('public')->delete($user->cover_image);
            }

            $user->cover_image = $data['cover_image']->store('cover_images', 'public');
        }

        $user->save();

        return $user->fresh();
    }

    public function updateProfileImage(array $data)
    {
        $user = Auth::user();

        // Profile image update
        if (!empty($data['profile_image'])) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $user->profile_image = $data['profile_image']->store('profile_images', 'public');
        }

        $user->save();

        // dd($user->profile_image); 

        return $user;
    }
}
