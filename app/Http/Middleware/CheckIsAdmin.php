<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login first');
        }
        if (! $request->user()->isAdmin($request->user()->role)) {
            // If authenticated user is not ADMIN then abort
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
