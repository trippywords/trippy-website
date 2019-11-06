<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = $request->user()->roles;
        
        foreach ($roles as $role) {
            if($role->name == 'super-admin')
                // If user is super-admin, accept the request
                return $next($request);
        }
        // If user does not have the super-admin role redirect them to another page that isn't restricted
        return redirect('/');        
    }
}
