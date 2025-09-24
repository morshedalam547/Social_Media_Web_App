<?php

namespace App\Http\Controllers;
use App\Services\UpdateService;
use App\Http\Requests\CoverUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileImageUpdateRequest;
use App\Repositories\ProfileRepositoryInterface;
use App\DTOs\ProfileDTO;
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
        $posts = $user->posts;

        return view('UserProfile', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = $this->profileRepo->getUser();
        return view('profile.edit', compact('user'));
    }

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

    public function updateCover(CoverUpdateRequest $request)
    {
        $this->profileRepo->updateCover([
            'cover_image' => $request->file('cover_image'),
        ]);

        notifySuccess('Cover image updated successfully.');
        return back();
    }

    // public function updateProfileImage(ProfileImageUpdateRequest $request)
    // {
    //     $this->profileRepo->updateProfileImage([
    //         'profile_image' => $request->file('profile_image'),
    //     ]);

    //     notifySuccess('Profile image updated successfully.');

    //     return back();
    // }


    public function updateProfileImage(ProfileImageUpdateRequest $request, UpdateService $service)
    {
        $image = new profileDTO(

            $request->file('profile_image'),

        );

        $service->createProfile($image);


        notifySuccess('Cover image updated successfully.');
        return back();
    }
}
