<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // Store a new supplier
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',
        ]);

        Supplier::create($request->only('name', 'contact', 'address'));

        return redirect()->back()->with('success', 'Supplier added successfully.');
    }
}
