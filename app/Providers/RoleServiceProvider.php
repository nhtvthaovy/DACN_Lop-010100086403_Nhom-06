<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Đăng ký directive Blade `@hasrole`
        Blade::if('hasrole', function ($roles) {
            // Kiểm tra nếu $roles là một mảng
            if (is_array($roles)) {
                // Nếu là mảng, kiểm tra nếu người dùng có bất kỳ vai trò nào trong mảng
                return Auth::guard('admin')->check() && Auth::guard('admin')->user()->roles->pluck('name')->intersect($roles)->isNotEmpty();
            }

            // Nếu chỉ có một vai trò duy nhất
            return Auth::guard('admin')->check() && Auth::guard('admin')->user()->roles->contains('name', $roles);
        });
    }
}
