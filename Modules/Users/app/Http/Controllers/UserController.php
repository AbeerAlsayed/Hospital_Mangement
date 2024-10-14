<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->createUser($data);

        return ApiResponseService::success($user, 'User created successfully');
    }

    public function show($id)
    {
        $user = $this->userService->getUser($id);
        return ApiResponseService::success($user, 'User fetched successfully');
    }

    public function update(StoreUserRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->userService->updateUser($data, $id);
        return ApiResponseService::success($user, 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return ApiResponseService::success(null, 'User deleted successfully');
    }

    // تابع جديد للحصول على جميع المستخدمين
    public function index()
    {
        $users = $this->userService->getAllUsers(); // استدعاء خدمة جلب جميع المستخدمين
        return ApiResponseService::success($users, 'All users fetched successfully');
    }
}
