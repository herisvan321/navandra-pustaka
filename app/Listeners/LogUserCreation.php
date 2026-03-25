<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Facades\Log;

class LogUserCreation
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
    public function handle(UserCreated $event): void
    {
        Log::info('User baru telah dibuat:', [
            'id' => $event->user->id,
            'email' => $event->user->email,
        ]);
    }
}
