<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

// Welcome / Public Home
Route::get('/', [HomeController::class, 'index']);

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
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    // Route::post('/{post}/like', [LikeController::class, 'like'])->name('like');
    Route::post('/{post}/comment', [CommentController::class, 'store'])->name('comment.store');

    });
Route::post('posts/like', [LikeController::class, 'like'])->name('posts.like');

//Password Routes
Route::prefix('password')->name('password.')->group(function () {
    Route::get('/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
     
    Route::get('/reset/{token}', [NewPasswordController::class, 'create'])->name('reset');
    Route::post('/reset', [NewPasswordController::class, 'store'])->name('update');
});

require __DIR__.'/auth.php';



