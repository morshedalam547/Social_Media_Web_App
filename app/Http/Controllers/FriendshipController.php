<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;
use Auth;

class FriendshipController extends Controller
{
    // Send Friend Request
    public function sendRequest(User $user)
    {
        if($user->id == auth()->id()) {
            return back()->with('error', 'You cannot add yourself.');
        }

        $exists = Friendship::where(function($q) use($user){
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $user->id);
        })->orWhere(function($q) use($user){
            $q->where('sender_id', $user->id)
              ->where('receiver_id', auth()->id());
        })->exists();

        if($exists){
            return back()->with('error', 'Friend request already sent or already friends.');
        }

        Friendship::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
        ]);

        return back()->with('success', 'Friend request sent.');
    }

    // Accept Request
    public function acceptRequest(Friendship $friendship)
    {
        if($friendship->receiver_id != auth()->id()) abort(403);

        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted.');
    }

    // Reject Request
    public function rejectRequest(Friendship $friendship)
    {
        if($friendship->receiver_id != auth()->id()) abort(403);

        $friendship->update(['status' => 'rejected']);

        return back()->with('success', 'Friend request rejected.');
    }

public function friendsList()
{
    $friends = auth()->user()->friends()->get();
    return view('friends.index', compact('friends'));
}


}
