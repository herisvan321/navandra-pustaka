<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected DashboardRepository $repository;

    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSummaryStats(): array
    {
        return $this->repository->getStats();
    }
}
