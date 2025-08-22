<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\LikeRepository;
use App\Repositories\LikeRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
