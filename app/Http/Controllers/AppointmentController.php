<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments with all form data (clients, employees, services).
     */
    public function index()
    {
        $appointments = Appointment::with(['client', 'employee', 'service'])->latest()->paginate(10);
        $clients = Client::all();
        $employees = Employee::all();
        $services = Service::all();

        return view('admin.scheduling', compact('appointments', 'clients', 'employees', 'services'));
    }

    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'employee_id'    => 'required|exists:employees,id',
            'service_id'     => 'required|exists:services,id',
            'scheduled_date' => 'required|date',
            'start_time'     => 'required',
            'end_time'       => 'required',
            'status'         => 'required|in:scheduled,completed,cancelled',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled successfully.');
    }

    /**
     * Show a single appointment.
     */
    public function show($id)
    {
        $appointment = Appointment::with(['client', 'employee', 'service'])->findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Notify the client (placeholder logic).
     */
    public function notifyClient($id)
    {
        // You can implement actual notification logic (email, SMS, etc.)
        return back()->with('success', 'Client notified successfully.');
    }

    /**
     * Notify the employee (placeholder logic).
     */
    public function notifyEmployee($id)
    {
        // You can implement actual notification logic (email, SMS, etc.)
        return back()->with('success', 'Employee notified successfully.');
    }

    /**
     * Remove the specified appointment.
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return back()->with('success', 'Appointment deleted successfully.');
    }
}
