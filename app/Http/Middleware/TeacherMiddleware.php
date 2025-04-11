<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class TeacherMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->type != 1) {
            return redirect('/login');
        }

        return $next($request);
    }
}
