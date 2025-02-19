<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $data);
    public function updateUserRole(User $user, string $role_id);
}
