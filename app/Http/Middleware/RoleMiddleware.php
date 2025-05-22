<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $roles = explode('|', $role);
        if(!in_array(Auth::user()->role->role_name, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
