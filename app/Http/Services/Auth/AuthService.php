<?php

namespace App\Http\Services\Auth;

use App\Http\Services\Hash;
use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{

    private $userRepository;
    private $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
            $role = $this->roleRepository->getOneRole('user');
            $data['role_id'] = $role->id;
            $this->userRepository->createUser($data);
        }catch (\Exception $e) {
            throw $e;
        }
    }
}
