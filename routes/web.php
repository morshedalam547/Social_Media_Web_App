<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Welcome / Public Home
Route::get('/', [HomeController::class, 'home']);

Route::middleware('auth')->group(function () {
    
Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

// Profile Routes
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

    Route::post('/update-image', [ProfileController::class, 'updateProfileImage'])->name('updateImage');
    Route::post('/update-cover', [ProfileController::class, 'updateCover'])->name('updateCover');
    });
});

// Posts Routes
Route::prefix('posts')->name('posts.')->group(function () {
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::delete('/{post}', [PostController::class, 'destroy']);
    Route::post('/like', [LikeController::class, 'like'])->name('like');
    Route::post('/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    });

//Password Routes
Route::prefix('password')->name('password.')->group(function () {
    Route::get('/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
     
    Route::get('/reset/{token}', [NewPasswordController::class, 'create'])->name('reset');
    Route::post('/reset', [NewPasswordController::class, 'store'])->name('update');
});




Route::get('/user/{id}', [UserController::class, 'profile'])->name('user.profile');


Route::middleware('auth')->group(function(){
    Route::get('/friends/pending', [FriendshipController::class, 'pendingRequests'])->name('friend.pending');
    Route::post('/user/{user}/add-friend', [FriendshipController::class, 'sendRequest'])->name('friend.add');
    Route::post('/friendship/{friendship}/accept', [FriendshipController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friendship/{friendship}/reject', [FriendshipController::class, 'rejectRequest'])->name('friend.reject');
});

Route::get('/friends', [FriendshipController::class, 'friendsList'])->name('friends.list');

// routes/web.php
// Route::get('/notifications/read/{id}', function ($id) {
//     $notification = auth()->user()->notifications()->find($id);
//     if ($notification) {
//         $notification->markAsRead();
//     }
//     return redirect()->back();
// })->name('notifications.read');

//
// Chat page
Route::get('/chat/{friend}', [ChatController::class, 'show'])->name('chat.show');

// Send message
Route::post('/chat/{friend}/send', [ChatController::class, 'send'])->name('chat.send');

// Mark as seen
Route::post('/chat/{friend}/seen', [ChatController::class, 'markAsSeen'])->name('chat.seen');

// Get unread count (for AJAX polling)
Route::get('/chat/unread-count', [ChatController::class, 'unreadCount'])->name('chat.unreadCount');
require __DIR__.'/auth.php';



