<?php

namespace App\Events;

use App\Models\CompanyProfile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompanyProfileUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $companyProfile;

    /**
     * Create a new event instance.
     */
    public function __construct(CompanyProfile $companyProfile)
    {
        $this->companyProfile = $companyProfile;
    }
}
