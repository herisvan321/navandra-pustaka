<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(\App\Repositories\UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Create user with hashed password.
     */
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->create($data);
    }

    /**
     * Update user with optional password update.
     */
    public function updateUser($id, array $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $this->update($id, $data);
    }
}
