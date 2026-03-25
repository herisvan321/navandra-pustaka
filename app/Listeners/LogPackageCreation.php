<?php

namespace App\Listeners;

use App\Events\PackageCreated;
use Illuminate\Support\Facades\Log;

class LogPackageCreation
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
    public function handle(PackageCreated $event): void
    {
        Log::info('Paket baru telah dibuat:', [
            'id' => $event->package->id,
            'name' => $event->package->name,
        ]);
    }
}
