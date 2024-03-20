<?php

namespace App\Listeners;

use App\Events\CreateUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreatedUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateUser $event): void
    {
        Log::info($event->user->name . " has been created.");
    }
}
