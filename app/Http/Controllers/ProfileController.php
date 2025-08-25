<?php

namespace App\Http\Controllers;
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
        // $this->profileRepo->updateProfile($request->validated());

        $this->profileRepo->updateProfile([

            'name'         => $request->input('name'),
            'email'        =>$request->input('email'),
            'profile_image' =>$request->file('profile_image'),
        ]);

        notifySuccess('Profile updated successfully.');

        return redirect()->route('profile.show');
    }

public function updateCover(CoverUpdateRequest $request){

        // $this->profileRepo->updateCover($request->validated());

       $this->profileRepo->updateCover([

        'userCover' => $request->file('cover_image'), 
    ]);

     notifySuccess('cover Image updated successfully.');

    return back();
}
    
public function updateProfileImage(ProfileImageUpdateRequest $request)
{
    $this->profileRepo->updateProfileImage([

        'profile_image' => $request->file('profile_photo'), 
    ]);

    notifySuccess('Profile Image updated successfully.');
    return back();
}

}

