<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidation;
use App\Http\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        try {
            $validation = AuthValidation::getInstance();
            $result = $validation->validate('register', $request);
            if ($result !== true) {
                throw new ValidationException($result);
            }
            $this->authService->registerUser($request->all());
            return response()->json(['message' => 'Register Success'], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $validation = AuthValidation::getInstance();
            $result = $validation->validate('login', $request);
            if ($result !== true) {
                throw new ValidationException($result);
            }
            $user = $this->authService->loginUser($request->only(['email', 'password']));
            return response()->json($user, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            if($e->getCode() === 401){
                return response()->json([
                    'error' => 'Something went wrong',
                    'message' => $e->getMessage(),
                ], 401);
            }
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
