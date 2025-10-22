<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Laravel pagination dùng Tailwind (cho đẹp, đồng bộ UI)
        Paginator::useTailwind();

        // Chia sẻ biến $cartCount cho MỌI view (navbar dùng để hiện badge)
        View::composer('*', function ($view) {
            $userId = Auth::id();

            // Nếu có đăng nhập: đếm tổng quantity của user
            $cartCount = $userId
                ? (int) CartItem::where('user_id', $userId)->sum('quantity')
                : 0;

            // Nếu bạn có giỏ hàng guest lưu session, có thể thay thế block trên bằng:
            // $cartCount = $userId
            //     ? (int) CartItem::where('user_id', $userId)->sum('quantity')
            //     : collect(session('cart', []))->sum('quantity');

            $view->with('cartCount', $cartCount);
        });
    }
}
