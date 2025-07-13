<?php

// app/Http/Controllers/SchedulingController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Appointment;

class SchedulingController extends Controller
{
    public function index()
    {
        // Fetch clients, employees, services (all)
        $clients = Client::all();
        $employees = Employee::all();
        $services = Service::all();

        // Paginate appointments with related models, ordered by scheduled_date descending
        $appointments = Appointment::with(['client', 'employee', 'service'])
                                   ->orderBy('scheduled_date', 'desc')
                                   ->paginate(10);

        // Return view with data
        return view('admin.scheduling', compact('clients', 'employees', 'services', 'appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'scheduled_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|string',
        ]);

        Appointment::create($request->all());

        return redirect()->back()->with('success', 'Appointment scheduled successfully.');
    }
}
