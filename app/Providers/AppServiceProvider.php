<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function ($view) {
            $view->with('categories', Category::withCount('products')->get());
        });

        View::composer('layouts.navigation', function ($view) {
            $unread_noti_count = 0;
            $unread_noti_count = auth()->guard('web')->user()->unreadNotifications()->count();
            $view->with('unread_noti_count', $unread_noti_count);
        });
    }
}
