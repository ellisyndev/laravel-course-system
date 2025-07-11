<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // 限制只能是 Admin 類型
        if (! $user instanceof \App\Models\Admin) {
            return response()->json(['message' => 'Unauthorized. Admin access only.'], 401);
        }

        return $next($request);
    }
}
