<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Services\UserService;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Transformers\UserResource;
use App\Services\ApiResponseService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // عرض جميع المستخدمين
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return ApiResponseService::paginated(
            $users,
            'Users fetched successfully'
        );
    }

    // إنشاء مستخدم جديد
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return ApiResponseService::success(
            new UserResource($user),
            'User created successfully'
        );
    }

    // عرض بيانات مستخدم معين بناءً على الـ ID
    public function show($id)
    {
        $user = $this->userService->getUser($id);
        return ApiResponseService::success(
            new UserResource($user),
            'User fetched successfully'
        );
    }

    // تحديث بيانات مستخدم معين
    public function update(StoreUserRequest $request, $id)
    {
        $user = $this->userService->updateUser($request->validated(), $id);
        return ApiResponseService::success(
            new UserResource($user),
            'User updated successfully'
        );
    }

    // حذف مستخدم معين
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return ApiResponseService::success(
            null,
            'User deleted successfully'
        );
    }
}
