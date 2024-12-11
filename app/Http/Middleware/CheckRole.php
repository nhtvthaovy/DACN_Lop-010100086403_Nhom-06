<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!Auth::guard('admin')->check()) {
            abort(403, 'Unauthorized'); // Nếu chưa đăng nhập, trả về lỗi 403
        }

        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::guard('admin')->user();

        // Kiểm tra xem người dùng có vai trò nào trong danh sách các vai trò được cấp quyền
        foreach ($roles as $role) {
            if ($user->roles->pluck('name')->contains($role)) {
                // Nếu có ít nhất một vai trò phù hợp, cho phép tiếp tục request
                return $next($request);
            }
        }

        return back();
    }
}
