<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        switch ($user->role) {
            case 'admin':
                return redirect('admin/dashboard');

            case 'manager':
                return redirect('manager/dashboard');

            case 'employee':
            case 'agent':
                return redirect('agent/dashboard');

            case 'customer':
                return redirect('customer/dashboard');

            case 'support':
                return redirect('support/dashboard');

            case 'inventory':
                return redirect('inventory/dashboard');

            case 'hr':
                return redirect('hr/dashboard');

            case 'analyst':
                return redirect('analyst/dashboard');

            case 'technician':
                return redirect('technician/dashboard');

            case 'ai':
                return redirect('ai/dashboard');

            default:
                return redirect()->intended(route('dashboard'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    // In AuthenticatedSessionController.php
      public function destroy(Request $request)
      {
          Auth::logout();

          $request->session()->invalidate();
          $request->session()->regenerateToken();

          return redirect('/login');
      }

}
