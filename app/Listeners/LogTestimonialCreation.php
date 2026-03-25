<?php

namespace App\Listeners;

use App\Events\TestimonialCreated;
use Illuminate\Support\Facades\Log;

class LogTestimonialCreation
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
    public function handle(TestimonialCreated $event): void
    {
        Log::info('Testimoni baru telah dibuat:', [
            'id' => $event->testimonial->id,
            'name' => $event->testimonial->name,
        ]);
    }
}
