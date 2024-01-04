<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Auth::guard($guards)->check() && Auth::user()->role == 1) {
            return redirect()->route("admin.dashboard");
        } elseif (Auth::guard($guards)->check() && Auth::user()->role == 2) {
            return redirect()->route("user.dashboard");
        } else {
            return $next($request);
        }
    }
}
