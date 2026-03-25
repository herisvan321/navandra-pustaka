<?php

namespace App\Listeners;

use App\Events\FaqCreated;
use Illuminate\Support\Facades\Log;

class LogFaqCreation
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
    public function handle(FaqCreated $event): void
    {
        Log::info('FAQ baru telah dibuat:', [
            'id' => $event->faq->id,
            'question' => $event->faq->question,
        ]);
    }
}
