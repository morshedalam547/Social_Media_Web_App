<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoverUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileImageUpdateRequest;
use App\Repositories\ProfileRepositoryInterface;

class ProfileController extends Controller
{

    /**
     * Inject ProfileRepository dependency
     */
    public function __construct(protected ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    //Display the user profile along with posts
    public function show()
    {
        $user = $this->profileRepo->getUser();
        $posts = $user->posts;

        // Blade এ data pass
        return view('UserProfile', compact('user', 'posts'));
    }

    //Show the profile edit form
    public function edit()
    {
        $user = $this->profileRepo->getUser();
        return view('profile.edit', compact('user'));
    }

    //Update user profile information
    public function update(ProfileUpdateRequest $request)
    {
        $this->profileRepo->updateProfile([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profile_image' => $request->file('profile_image'),
        ]);

        notifySuccess('Profile updated successfully.');
        return redirect()->route('profile.show');
    }

    //Update user cover photo
    public function updateCover(CoverUpdateRequest $request)
    {
        $this->profileRepo->updateCover([
            'cover_image' => $request->file('cover_image'),
        ]);

        notifySuccess('Cover image updated successfully.');
        return back();
    }

    //Update only the profile picture
    public function updateProfileImage(ProfileImageUpdateRequest $request)
    {
        $this->profileRepo->updateProfileImage([
            'profile_image' => $request->file('profile_image'),
        ]);

        notifySuccess('Profile image updated successfully.');
        return back();
    }
}


