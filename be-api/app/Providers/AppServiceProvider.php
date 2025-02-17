<?php

namespace App\Providers;

use App\Listeners\SendJobPostCreationNotification;
use App\Repositories\JobBoard\JobBoardRepository;
use App\Repositories\JobBoard\JobBoardRepositoryInterface;
use App\Repositories\JobPost\ExternalJobPostRepository;
use App\Repositories\JobPost\JobPostRepository;
use App\Repositories\JobPost\JobPostRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Contracts\ExternalJobPostServiceInterface;
use App\Services\Contracts\JobBoardServiceInterface;
use App\Services\Contracts\JobPostsServiceInterface;
use App\Services\Contracts\UsersServiceInterface;
use App\Services\ExternalJobPostService;
use App\Services\JobBoardService;
use App\Services\JobPostsService;
use App\Services\UsersService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        JobBoardServiceInterface::class => JobBoardService::class,
        UsersServiceInterface::class => UsersService::class,
        JobPostsServiceInterface::class => JobPostsService::class,
        ExternalJobPostServiceInterface::class => ExternalJobPostService::class,
    ];

    public function register(): void
    {
        $this->registerRepositories();
    }

    public function boot(): void
    {
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(
            JobBoardRepositoryInterface::class,
            JobBoardRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->when(JobPostsService::class)
            ->needs(JobPostRepositoryInterface::class)
            ->give(JobPostRepository::class);

        $this->app->when(ExternalJobPostService::class)
            ->needs(JobPostRepositoryInterface::class)
            ->give(ExternalJobPostRepository::class);

        $this->app->when(SendJobPostCreationNotification::class)
            ->needs(JobPostRepositoryInterface::class)
            ->give(JobPostRepository::class);

    }
}
