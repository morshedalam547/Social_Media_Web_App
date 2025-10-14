<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FriendRequestAccepted extends Notification
{
    use Queueable;

    protected $friend;

    public function __construct($friend)
    {
        $this->friend = $friend;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->friend->name} accepted your friend request.",
            'friend_id' => $this->friend->id,
            'friend_image' => $this->friend->profile_image ?? null,
        ];
    }
}
