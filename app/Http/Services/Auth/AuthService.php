<?php

namespace App\Http\Services\Auth;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginUser(array $credentials)
    {
        try {
            if (!$token = auth()->attempt($credentials)) {
                throw new \Exception('Invalid credentials', 401);
            }
            return [
                'token' => $token,
            ];
        }catch (\Exception $e) {
            throw $e;
        }
    }

    public function registerUser(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = '9d3fdf48-f094-4083-9ccb-7e89420c4d66';
            $user = $this->userRepository->createUser($data);
            return $user;
        }catch (\Exception $e) {
            throw $e;
        }
    }
}
