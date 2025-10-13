<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function profile($id)
{
    // User fetch with posts, comments, likes
    $user = User::with(['posts.likes', 'posts.comments.user'])->findOrFail($id);

    // $user->posts use করলে sidebar বা profile এ সব post দেখানো যাবে
    return view('user.profile', [
        'user' => $user,
        'posts' => $user->posts()->latest()->get(), // posts কে latest order এ পাঠানো হলো
    ]);
}
}