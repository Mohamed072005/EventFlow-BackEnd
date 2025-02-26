<?php

namespace App\Http\Services\User;

use App\Http\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{

    public function filterUsersByOrganizer($users)
    {
        $organizerCount = 0;
        foreach ($users as $user) {
            if (isset($user->role->role_name) && $user->role->role_name == 'organizer') {
                $organizerCount++;
            }
        }

        return $organizerCount;
    }
}