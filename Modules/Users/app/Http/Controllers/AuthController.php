<?php

namespace Modules\Users\Http\Controllers;

use Modules\Users\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Modules\Users\Services\AuthService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // حاول تسجيل الدخول باستخدام بيانات الاعتماد
        $response = $this->authService->login($credentials);

        // تحقق إذا كانت العملية بها خطأ
        if ($response['status'] === 'error') {
            return ApiResponseService::error($response['message'], $response['code']);
        }

        // إذا تم تسجيل الدخول بنجاح، تحقق من دور المستخدم
        $user = $response['user'];
        if (!in_array($user->role, ['admin', 'doctor'])) {
            return ApiResponseService::error('Unauthorized: You do not have access to this application.', 403);
        }

        // إذا كان الدور صحيحًا، أرجع الاستجابة
        return ApiResponseService::success([
            'user' => $user,
            'authorisation' => [
                'token' => $response['token'],
                'type' => 'bearer',
            ]
        ], 'Login successful', $response['code']);
    }



    public function logout()
    {
        $response = $this->authService->logout();
        return ApiResponseService::success(null, $response['message'], $response['code']);
    }
}
