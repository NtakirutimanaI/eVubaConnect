<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Manager
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'manager') {
           abort(403, 'Unauthorized access - Managers only');
          }


        return $next($request);
    }
}
