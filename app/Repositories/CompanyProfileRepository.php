<?php

namespace App\Repositories;

use App\Models\CompanyProfile;

class CompanyProfileRepository extends BaseRepository
{
    public function __construct(CompanyProfile $model)
    {
        parent::__construct($model);
    }
}
