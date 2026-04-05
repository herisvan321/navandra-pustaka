<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\Package;

class PackageService extends BaseService
{
    public function __construct(\App\Repositories\PackageRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Handle array features serialization.
     */
    public function createPackage(array $data)
    {
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }
        return $this->create($data);
    }

    /**
     * Handle array features serialization.
     */
    public function updatePackage($id, array $data)
    {
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }
        return $this->update($id, $data);
    }
}
