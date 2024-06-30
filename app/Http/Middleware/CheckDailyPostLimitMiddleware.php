<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CheckDailyPostLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maxDailyPosts = 3;
        $userId = Auth::id();
        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();
        $dailyPostCount = Post::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfDay, $endOfDay])
            ->count();
        if ($dailyPostCount >= $maxDailyPosts) {
            return response()->json([
                'status'=>false,
                'message' => 'Gunluk Post Limtinizi Astiniz!!'
            ],500);
        }
        return $next($request);
    }
}
