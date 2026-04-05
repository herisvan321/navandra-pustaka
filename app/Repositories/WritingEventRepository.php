<?php

namespace App\Repositories;

use App\Models\WritingEvent;

class WritingEventRepository extends BaseRepository
{
    public function __construct(WritingEvent $model)
    {
        parent::__construct($model);
    }
}
