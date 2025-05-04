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
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/' , $routeName);
        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();

        if(Auth::check()){
            if(!in_array($route[0] , $roleRoutes)){
                return $next($request);
            }else{
                if($route[0] != Auth::user()->roles[0]->allowed_route){
                    $path = $route[0] == Auth::user()->roles[0]->allowed_route ? $route[0]. '.login' : ''  . Auth::user()->roles[0]->allowed_route.'.index';
                    return redirect()->route($path);
                }else{
                    return $next($request);
                }
            }
        }else{
            $routeDestination = in_array($route[0] , $roleRoutes) ? $route[0].'.login' : 'login';
            $path = $route[0] != '' ? $routeDestination : Auth::user()->roles[0]->allowed_route.'.index';
            return redirect()->route($path);
        }
    }
}
