<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Auth;

class ChatController extends Controller
{
    // Show chat page with a friend
    public function show($friendId)
    {
        $friend = User::findOrFail($friendId);

        $messages = Message::where(function($q) use($friendId){
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $friendId);
        })->orWhere(function($q) use($friendId){
            $q->where('sender_id', $friendId)
              ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('chat.show', compact('friend', 'messages'));
    }

    // Send a message to friend
    public function send(Request $request, $friendId)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $friendId,
            'message' => $request->message,
            'seen' => false
        ]);

        return response()->json($message);
    }

    // Get unread message count
    public function unreadCount()
    {
        $messages = Message::where('receiver_id', auth()->id())
                           ->where('seen', false)
                           ->get();

        // Group by friend (sender)
        $byFriend = $messages->groupBy('sender_id')->map(function($group) {
            return count($group);
        })->toArray();

        return response()->json([
            'count' => $messages->count(),
            'byFriend' => $byFriend
        ]);
    }

    // Mark messages from a friend as seen
    public function markAsSeen($friendId)
    {
        Message::where('sender_id', $friendId)
               ->where('receiver_id', auth()->id())
               ->where('seen', false)
               ->update(['seen' => true]);

        // Return updated unread count
        $totalUnread = Message::where('receiver_id', auth()->id())
                              ->where('seen', false)
                              ->count();

        return response()->json(['status' => 'ok', 'unreadCount' => $totalUnread]);
    }
}
