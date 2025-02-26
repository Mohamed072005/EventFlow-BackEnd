<?php

namespace App\Http\Services\User;


interface UserServiceInterface
{
    public function filterUsersByOrganizer($users);
}