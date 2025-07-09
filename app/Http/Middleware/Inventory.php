<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Inventory
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

       if (Auth::user()->role !== 'inventory') {
    abort(403, 'Unauthorized access - Inventory Officers only');
}


        return $next($request);
    }
}
