<?php

namespace Modules\Users\Http\Controllers;

use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Services\UserService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
// use App\Http\Controllers;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userService->createUser($data);

        return ApiResponseService::success($user, 'User created successfully');
    }

    public function show($id): JsonResponse
    {
        $user = $this->userService->getUser($id);
        return ApiResponseService::success($user, 'User fetched successfully');
    }

    public function update(StoreUserRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userService->updateUser($data, $id);
        return ApiResponseService::success($user, 'User updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $this->userService->deleteUser($id);
        return ApiResponseService::success(null, 'User deleted successfully');
    }

    // تابع جديد للحصول على جميع المستخدمين
    public function getAll(): JsonResponse
    {
        $users = $this->userService->getAllUsers(); // استدعاء خدمة جلب جميع المستخدمين
        return ApiResponseService::success($users, 'All users fetched successfully');
    }
}
