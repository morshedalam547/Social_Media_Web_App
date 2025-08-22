<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getUser()
    {
        return Auth::user();
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function updateCover(Request $request)
    {
        $user = Auth::user();

        if ($user->cover_image && Storage::disk('public')->exists($user->cover_image)) {
            Storage::disk('public')->delete($user->cover_image);
        }

        $user->cover_image = $request->file('cover_image')->store('cover_images', 'public');
        $user->save();

        return $user;
    }

    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        $user->save();

        return $user;
    }
}
