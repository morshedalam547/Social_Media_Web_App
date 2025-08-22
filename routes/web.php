<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware(['auth'])->group(function () {
    Route::get('/dashboardFb', [PostController::class, 'index'])->name('dashboard');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

});


Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');


Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');


    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');




Route::middleware('guest')->group(function () {
    // Forgot Password Form
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    // Send Reset Link Email
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset Password Form
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    // Update Password
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});




Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
Route::post('/profile/update-cover', [ProfileController::class, 'updateCover'])->name('profile.updateCover');

Route::post('/profile/update-image', [ProfileController::class, 'updateProfileImage'])->name('profile.updateProfileImage');
require __DIR__.'/auth.php';
