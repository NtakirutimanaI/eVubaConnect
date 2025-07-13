<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display a list of clients (GET /clients)
    public function index()
    {
        $clients = Client::latest()->paginate(10); // pagination
        return view('clients', compact('clients'));
    }

    // Show the form for creating a new client (GET /clients/create)
    public function create()
    {
        return view('clients.create');
    }

    // Store a newly created client in DB (POST /clients)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'nullable|email|max:255|unique:clients,email',
            'phone'     => 'nullable|string|max:255',
            'company'   => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()->route('clients')->with('success', 'Client added successfully.');
    }

    // Show a single client (GET /clients/{client})
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Show the form for editing a client (GET /clients/{client}/edit)
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Update a client in DB (PUT/PATCH /clients/{client})
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            // Allow the current client's email, but unique across others
            'email'     => 'nullable|email|max:255|unique:clients,email,' . $client->id,
            'phone'     => 'nullable|string|max:255',
            'company'   => 'nullable|string|max:255',
            'address'   => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('clients')->with('success', 'Client updated successfully.');
    }

    // Delete a client (DELETE /clients/{client})
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients')->with('success', 'Client deleted successfully.');
    }
}
