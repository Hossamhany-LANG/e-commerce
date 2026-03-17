<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if ($request->is('admin/login') || $request->is('login')) {
            return $next($request);
        }

        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/', $routeName);
        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();

        if (Auth::check()) {
            $userRole = Auth::user()->roles->first()->allowed_route ?? null;

            if (in_array($route[0], $roleRoutes) && $route[0] != $userRole) {
                return redirect()->route($userRole . '.index');
            }
            return $next($request);
        }

        if (in_array($route[0], $roleRoutes)) {
            return redirect()->route('admin.login_page');
        }

        return $next($request);
    }
}
