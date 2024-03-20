<?php

namespace App\Listeners;

use App\Events\UpdateUser;
use Illuminate\Support\Facades\Log;

class SendUpdatedUserNotification
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
    public function handle(UpdateUser $event): void
    {
        Log::info($event->user->name.' has been updated.');
    }
}
