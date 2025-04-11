<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        // Для преподавателей (type = 1 в вашей БД)
        if ($role == 'teacher' && $user->type != 1) {
            abort(403);
        }

        // Для студентов (type = 0 в вашей БД)
        if ($role == 'student' && $user->type != 0) {
            abort(403);
        }

        return $next($request);
    }
}
