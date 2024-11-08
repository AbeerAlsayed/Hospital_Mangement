<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // تحقق من كون المستخدم مسجلاً للدخول
        if (!Auth::guard('api')->check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // تحقق مما إذا كان الدور موجودًا في قائمة الأدوار
        $user = Auth::guard('api')->user();
        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        return $next($request);
    }
}
