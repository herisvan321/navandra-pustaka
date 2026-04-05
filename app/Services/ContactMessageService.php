<?php

namespace App\Services;

use App\Repositories\ContactMessageRepository;

class ContactMessageService extends BaseService
{
    public function __construct(ContactMessageRepository $repository)
    {
        parent::__construct($repository);
    }
}
