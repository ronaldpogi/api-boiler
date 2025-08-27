<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected UserRepository $userRepository) {}

    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());

        // Create token for API usage
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], 'User registered successfully', 201);
    }

    /**
     * Login user and issue token
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->error('Invalid credentials', [], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], 'Login successful');
    }

    /**
     * Logout user (revoke tokens)
     */
    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->success(null, 'Logged out successfully');
    }

    /**
     * Get authenticated user
     */
    public function me(): JsonResponse
    {
        return response()->success(new UserResource(Auth::user()));
    }
}
