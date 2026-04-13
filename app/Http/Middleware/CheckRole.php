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
    public function handle(Request $request, Closure $next,  $role)
    {
        $userRole = session('role');

        // Cek apakah role sesuai
        if ($userRole !== $role) {
            return redirect('/unauthorized'); // atau abort(403);
        }
        return $next($request);
    }
}
