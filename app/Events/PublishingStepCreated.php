<?php

namespace App\Events;

use App\Models\PublishingStep;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublishingStepCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $publishingStep;

    /**
     * Create a new event instance.
     */
    public function __construct(PublishingStep $publishingStep)
    {
        $this->publishingStep = $publishingStep;
    }
}
