<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;

class ClientProductController extends Controller
{
    /**
     * Display a listing of the clients and products.
     */
    public function index()
    {
        $clients = Client::latest()->get();
        $products = Product::latest()->get();

        return view('admin.client_products.index', compact('clients', 'products'));
    }

    /**
     * Show the form for creating a new client and product.
     */
    public function create()
    {
        return view('admin.client_products.create');
    }

    /**
     * Store a newly created client and product in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:20',
            'company'       => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:500',
            'product_name'  => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'quantity'      => 'required|numeric|min:0',
            'price'         => 'required|numeric|min:0',
        ]);

        // 1. Create client
        $client = Client::create([
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'company'   => $request->company,
            'address'   => $request->address,
        ]);

        // 2. Create product and link it to the client
        $product = Product::create([
            'name'        => $request->product_name,
            'category'    => $request->category,
            'quantity'    => $request->quantity,
            'unit'        => 'pcs', // change this if needed
            'price'       => $request->price,
            'supplier_id' => 1, // use appropriate value or make it dynamic
            'client_id'   => $client->id, // LINK TO CLIENT
        ]);

        return redirect()->back()->with('success', 'Client and Product saved successfully!');
    }

    /**
     * Display the specified client and product details.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client_products.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client_products.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'company'   => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:500',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->only(['full_name', 'email', 'phone', 'company', 'address']));

        return redirect()->route('client-products.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified client and optionally related products.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        // Optionally delete related products
        // Product::where('client_id', $id)->delete();

        return redirect()->back()->with('success', 'Client deleted successfully!');
    }
}
