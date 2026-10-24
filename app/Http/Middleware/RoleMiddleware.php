<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!in_array($request->user()->role, $roles)) {
            // Redirect to appropriate dashboard based on actual role
            if ($request->user()->isSuperAdmin()) {
                return redirect()->route('superadmin.dashboard');
            } elseif ($request->user()->isHrd()) {
                return redirect()->route('hrd.dashboard');
            } else {
                return redirect()->route('applicant.dashboard');
            }
        }

        return $next($request);
    }
}
