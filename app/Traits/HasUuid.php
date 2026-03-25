<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Initialize the trait.
     */
    public function initializeHasUuid()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
        $this->id = (string) Str::uuid();
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     */
    public function getKeyType()
    {
        return 'string';
    }
}
