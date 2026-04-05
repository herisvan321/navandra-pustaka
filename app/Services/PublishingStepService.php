<?php

namespace App\Services;

use App\Repositories\PublishingStepRepository;

class PublishingStepService extends BaseService
{
    public function __construct(PublishingStepRepository $repository)
    {
        parent::__construct($repository);
    }
}
