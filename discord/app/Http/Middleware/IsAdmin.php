<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('middleware IsAdmin');
        
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $role = $user->role_id;

        if ($role != 1) {
            return response()->json([
                'success' => true,
                'message' => "Unauthorized"
            ]);
        }

        return $next($request);
    }
}
