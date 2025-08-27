<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserRepository $userRepository) {}

    /**
     * List users
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->all();
        return response()->success(UserResource::collection($users));
    }

    /**
     * Create user
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        return response()->success(new UserResource($user), 'User created successfully', 201);
    }

    /**
     * Show single user
     */
    public function show($id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        return response()->success(new UserResource($user));
    }

    /**
     * Update user
     */
    public function update(UserRequest $request, $id): JsonResponse
    {
        $user = $this->userRepository->update($id, $request->validated());
        return response()->success(new UserResource($user), 'User updated successfully', 201);
    }

    /**
     * Delete user
     */
    public function destroy($id): JsonResponse
    {
        $this->userRepository->delete($id);
        return response()->success(null, 'User deleted successfully');
    }
}

