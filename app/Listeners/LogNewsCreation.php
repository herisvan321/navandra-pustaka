<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use Illuminate\Support\Facades\Log;

class LogNewsCreation
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
    public function handle(NewsCreated $event): void
    {
        Log::info('Berita baru telah dibuat:', [
            'id' => $event->news->id,
            'title' => $event->news->title,
        ]);
    }
}
