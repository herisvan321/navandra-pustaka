<?php

namespace App\Services;

use App\Repositories\WritingEventRepository;

class WritingEventService extends BaseService
{
    public function __construct(WritingEventRepository $repository)
    {
        parent::__construct($repository);
    }
}
