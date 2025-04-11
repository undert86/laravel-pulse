<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param
     */
    public function handle($request, Closure $next, ...$types)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!in_array(auth()->user()->type, $types)) {
            abort(403, 'Доступ запрещен');
        }

        return $next($request);
    }
}
