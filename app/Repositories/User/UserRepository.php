<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
        ]);
    }

    public function updateUserRole(User $user, string $role_id)
    {
        $user->role_id = $role_id;
        $user->save();
    }
}
