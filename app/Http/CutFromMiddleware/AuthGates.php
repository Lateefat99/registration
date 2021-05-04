<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            $roles = Role::with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role){
                foreach ($role->permissions as $permissions){
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            foreach ($permissionsArray as $title => $roles){
                \Illuminate\Support\Facades\Gate::define($title, function ($user) use ($roles){
                    return  count(array_intersect($user->$roles->pluck(id)->toArray));
                });
            }
        }
        return $next($request);
    }
}
