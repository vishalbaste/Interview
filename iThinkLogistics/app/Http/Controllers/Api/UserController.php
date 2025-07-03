<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllUsers(), 200);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->createUser($request->validated());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = $this->service->getUser($id);
        return $user ? response()->json($user) : response()->json(['error' => 'User not found'], 404);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->service->updateUser($user, $request->validated());
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        Cache::forget('users.all');
        // Cache::forget("users.{$user->id}");

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
