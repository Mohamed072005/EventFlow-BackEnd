<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function getOneRole(string $role);
    public function getRoleById(string $id);
}
