<?php

namespace App\Listeners;

use App\Events\ContactMessageCreated;
use Illuminate\Support\Facades\Log;

class LogContactMessageCreation
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
    public function handle(ContactMessageCreated $event): void
    {
        Log::info('Pesan kontak baru telah diterima:', [
            'id' => $event->contactMessage->id,
            'from' => $event->contactMessage->email,
        ]);
    }
}
