<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    foreach ($roles as $role) {
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }
    }

    return response()->json(['message'=>'Unauthorized !'],403);
}
}
