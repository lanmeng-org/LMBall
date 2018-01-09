<?php

namespace App\Http\Middleware;

use Closure;
use Bigecko\LaravelRbac\Route;

class Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if (is_null($user) || $user->id === 1) {
            return $next($request);
        }

        $roleNames = [];
        $permNames = [];
        foreach ($user->roles as $role) {
            $roleNames[] = $role->name;
            foreach ($role->permissions as $perm) {
                $permNames[] = $perm->name;
            }
        }

        // 路由权限控制
        $routeRules = Route::with(['permissions', 'roles'])->get();

        $access = null;
        foreach ($routeRules as $routeRule) {
            $roles = $routeRule->roles->pluck('name')->toArray();
            $perms = $routeRule->permissions->pluck('name')->toArray();

            if (preg_match("/{$routeRule->route}/", $request->path())) {

                if (!$routeRule->roles->isEmpty() && !$routeRule->permissions->isEmpty()) {
                    if (empty(array_intersect($roleNames, $roles)) && empty(array_intersect($permNames, $perms))) {
                        $access = false;
                    } else {
                        $access = true;
                        break;
                    }
                } elseif (!$routeRule->roles->isEmpty()) {
                    if (empty(array_intersect($roleNames, $roles))) {
                        $access = false;
                    } else {
                        $access = true;
                        break;
                    }
                } elseif (!$routeRule->permissions->isEmpty()) {
                    if (empty(array_intersect($permNames, $perms))) {
                        $access = false;
                    } else {
                        $access = true;
                        break;
                    }
                }
            }
        }

        if ($access === false) {
            \App::abort(403);
        }

        return $next($request);
    }
}
