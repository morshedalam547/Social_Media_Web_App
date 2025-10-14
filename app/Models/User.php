<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cover_image',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

public function sentRequests() {
    return $this->hasMany(Friendship::class, 'sender_id');
}

public function receivedRequests() {
    return $this->hasMany(Friendship::class, 'receiver_id');
}

public function friends()
{
    // sender হিসেবে accepted friends
    $sent = User::join('friendships', 'users.id', '=', 'friendships.receiver_id')
                ->where('friendships.sender_id', $this->id)
                ->where('friendships.status', 'accepted')
                ->select('users.*');

    // receiver হিসেবে accepted friends
    $received = User::join('friendships', 'users.id', '=', 'friendships.sender_id')
                    ->where('friendships.receiver_id', $this->id)
                    ->where('friendships.status', 'accepted')
                    ->select('users.*');

    // দুইটা query union করে collection return করবো
    return $sent->union($received)->get();
}



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    

}
