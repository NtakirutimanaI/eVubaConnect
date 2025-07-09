<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Hash;  

class HomeController extends Controller
{
    public function admin()
    {
        return view('admin.index');
    }

    public function manager()
    {
        return view('manager.index');
    }

    public function agent()
    {
        return view('agent.index');
    }

    public function customer()
    {
        return view('customer.index');
    }

    public function support()
    {
        return view('support.index');
    }

    public function inventory()
    {
        return view('inventory.index');
    }

    public function hr()
    {
        return view('hr.index');
    }

    public function analyst()
    {
        return view('analyst.index');
    }

    public function technician()
    {
        return view('technician.index');
    }

    public function ai()
    {
        return view('ai.index');
    }

    public function dashboard()
{
    $pending = Order::where('status', 'pending')->count();
    $processing = Order::where('status', 'processing')->count();
    $completed = Order::where('status', 'completed')->count();
    $cancelled = Order::where('status', 'cancelled')->count();

    return view('dashboard', compact('pending', 'processing', 'completed', 'cancelled'));
}


}
