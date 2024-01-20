<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (! $request->user()) {
            return redirect('/login');
        }

        if (! $roles) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if ($request->user()->rol->id == $role) {
                return $next($request);
            }
        }

        return redirect('/unauthorized');
    }

}