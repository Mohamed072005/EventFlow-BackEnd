<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getOneRole(string $role)
    {
        return Role::where('role_name', $role)->first();
    }

    public function getRoleById(string $id)
    {
        return Role::where('id', $id)->first();
    }
}
