<?php

namespace App\Http\Services\Auth;

interface AuthServiceInterface
{
    public function registerUser(array $data);
    public function loginUser(array $credentials);
}
