<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        if(request()->is('admin/*')) {
            view()->composer('*', function ($view){
            if(!Cache::has('admin_side_menu')) {
            Cache::forever('admin_side_menu', Permission::tree());
        }
        $admin_side_menu = Cache::get('admin_side_menu');
        $view->with(['admin_side_menu', $admin_side_menu]);
    });
        }
    }

}