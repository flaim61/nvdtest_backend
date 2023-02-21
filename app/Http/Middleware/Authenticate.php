<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::query()->where('remember_token', $request->header('Authorization'))->count();

        if ($user == 0) {
            response()->json([
                'status' => 'Unauthenticated',
                'message' => 'Your access token bad or expired. You need login again'
            ], 401)->send();
            exit; // Если тут не выйти, даже без авторизации выполнится обычный маршрут!
        }

        return $next($request);
    }
}
