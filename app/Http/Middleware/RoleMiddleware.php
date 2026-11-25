<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role->value, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to do this',
            ], 403);
        }

        return $next($request);
    }
}