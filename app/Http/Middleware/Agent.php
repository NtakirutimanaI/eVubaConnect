<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Agent
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Not logged in
            return redirect('/login');
        }

        $user = Auth::user();

        if (!in_array(Auth::user()->role, ['employee', 'agent'])) {
    abort(403, 'Unauthorized access - Agents only');
}


        return $next($request);
    }
}
