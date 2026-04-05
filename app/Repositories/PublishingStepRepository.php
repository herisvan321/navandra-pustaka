<?php

namespace App\Repositories;

use App\Models\PublishingStep;

class PublishingStepRepository extends BaseRepository
{
    public function __construct(PublishingStep $model)
    {
        parent::__construct($model);
    }
}
