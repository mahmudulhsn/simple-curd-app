<?php

namespace App\Providers;

use App\Events\CreateUser;
use App\Listeners\SendCreatedUserNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);

        Event::listen(
            CreateUser::class,
            SendCreatedUserNotification::class,
        );
    }
}
