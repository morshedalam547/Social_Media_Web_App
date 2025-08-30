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
                $query->with(['likes', 'comments.user'])
                    ->latest();
            }
        ]);

        return $user;
    }

    public function updateProfile(array $data)
    {
        // Logged-in user
        $user = Auth::user();

        // Update basic fields
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        // Delete old profile image if exists
        if (!empty($data['profile_image'])) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Store new profile image
        if (!empty($data['profile_image'])) {
            $user->profile_image = $data['profile_image']->store('profile_images', 'public');
        }
        // Save  to database
        $user->save();

        return $user->fresh();
    }

    public function updateCover(array $data)
    {
        $user = Auth::user();

        // Delete old cover image if exists
        if ($user->cover_image) {
            Storage::disk('public')->delete($user->cover_image);
        }

        // Store new cover image
        if (isset($data['userCover'])) {
            $user->cover_image = $data['userCover']->store('cover_images', 'public');

        }
        $user->save();
        return $user;
    }

    public function updateProfileImage(array $data)
    {

        $user = Auth::user();

        //old image delete
        if (!empty($data['profile_image'])) {
            Storage::disk('public')->delete($user->profile_image ?? '');

            // new Image Save
            $user->profile_image = $data['profile_image']->store('profile_images', 'public');
            $user->save();
        }

        return $user;

    }
}








