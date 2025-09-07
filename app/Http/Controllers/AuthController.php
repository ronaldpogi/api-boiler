<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected UserRepository $userRepository) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], __('messages.user_created'), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->error(__('messages.user_invalid_credential'), 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], __('messages.user_logged_in'));
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->success(null, __('messages.user_logged_out'));
    }

    public function me(): JsonResponse
    {
        return response()->success(new UserResource(Auth::user()));
    }
}
