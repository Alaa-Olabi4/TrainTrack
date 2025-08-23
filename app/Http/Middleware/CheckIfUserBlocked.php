<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserBlocked
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->status == 0) {
            return response()->json([
                'status' => 403,
                'message' => 'Your account is blocked. Please contact admin.',
            ], 403);
        }

        return $next($request);
    }
}
