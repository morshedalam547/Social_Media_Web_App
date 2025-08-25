<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfileRepositoryInterface;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\CoverUpdateRequest;
use App\Http\Requests\ProfileImageUpdateRequest;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    public function show()
    {
        $user = $this->profileRepo->getUser();
        $posts = $user->posts()->with(['likes', 'comments.user'])->latest()->get();

        return view('UserProfile', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = $this->profileRepo->getUser();
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->profileRepo->updateProfile($request);

        notifySuccess('Profile updated successfully.');

        return redirect()->route('profile.show');
    }

    public function updateCover(CoverUpdateRequest $request)
    {
        $this->profileRepo->updateCover($request);

        notifySuccess('Profile updated successfully.');

        return back();
    }

    public function updateProfileImage(ProfileImageUpdateRequest $request)
    {
        $this->profileRepo->updateProfileImage($request);

        notifySuccess('Profile updated successfully.');
        return back();
    }
}