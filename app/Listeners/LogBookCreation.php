<?php

namespace App\Listeners;

use App\Events\BookCreated;
use Illuminate\Support\Facades\Log;

class LogBookCreation
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
    public function handle(BookCreated $event): void
    {
        Log::info('Buku baru telah dibuat:', [
            'id' => $event->book->id,
            'title' => $event->book->title,
            'author' => $event->book->author,
        ]);
    }
}
