<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $posts = $user->posts()->with(['likes', 'comments.user'])->latest()->get();

        return view('UserProfile', compact('user', 'posts'));
    }

    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

          
            if ($user->profile_image && file_exists(storage_path('app/public/' . $user->profile_image))) {
                unlink(storage_path('app/public/' . $user->profile_image));
            }

  
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path; 

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

            notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration(3000) // 2 seconds
            ->success('Profile Update successfully.');
        return redirect()->route('profile.show');
    }


    

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


 public function updateCover(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->cover_image && file_exists(storage_path('public/' . $user->cover_image))) {
            unlink(storage_path('public/' . $user->cover_image));
        }

        $path = $request->file('cover_image')->store('cover_images', 'public');

        $user->cover_image = $path;
        $user->save();

        return back()->with('success', 'Cover photo updated successfully!');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_image && file_exists(storage_path('public/' . $user->profile_image))) {
            unlink(storage_path('public/' . $user->profile_image));
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');

        $user->profile_image = $path;
        $user->save();

        return back()->with('success', 'Profile photo updated successfully!');
    }


}
