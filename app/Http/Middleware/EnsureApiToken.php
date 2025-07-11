<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // 限制只能是 User 類型
        if (! $user instanceof \App\Models\User) {
            return response()->json(['message' => 'Unauthorized. User access only.'], 401);
        }

        return $next($request);
    }
}
