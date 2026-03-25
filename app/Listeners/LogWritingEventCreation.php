<?php

namespace App\Listeners;

use App\Events\WritingEventCreated;
use Illuminate\Support\Facades\Log;

class LogWritingEventCreation
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
    public function handle(WritingEventCreated $event): void
    {
        Log::info('Event menulis baru telah dibuat:', [
            'id' => $event->event->id,
            'title' => $event->event->title,
        ]);
    }
}
