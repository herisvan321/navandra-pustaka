<?php

namespace App\Listeners;

use App\Events\GalleryCreated;
use Illuminate\Support\Facades\Log;

class LogGalleryCreation
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
    public function handle(GalleryCreated $event): void
    {
        Log::info('Item galeri baru telah dibuat:', [
            'id' => $event->gallery->id,
            'title' => $event->gallery->title,
        ]);
    }
}
