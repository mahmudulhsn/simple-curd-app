<?php

namespace App\Providers;

use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\MediaRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AddressRepository;
use App\Repositories\MediaRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
