<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class WorkforceController extends Controller
{
    // Show all employees
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();

        $totalEmployees    = $employees->count();
        $activeEmployees   = $employees->where('status', 1)->count();
        $inactiveEmployees = $employees->where('status', 0)->count();

        return view('admin.workforce', compact(
            'employees',
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees'
        ));
    }

    // Store a new employee
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email'    => 'nullable|email|max:255|unique:employees,email',
            'status'   => 'required|boolean',
        ]);

        Employee::create([
            'name'     => $request->name,
            'position' => $request->position,
            'email'    => $request->email,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.workforce')->with('success', 'Employee added successfully.');
    }

    // Update an existing employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email'    => 'nullable|email|max:255|unique:employees,email,' . $employee->id,
            'status'   => 'required|boolean',
        ]);

        $employee->update([
            'name'     => $request->name,
            'position' => $request->position,
            'email'    => $request->email,
            'status'   => $request->status,
        ]);

        return redirect()->route('admin.workforce')->with('success', 'Employee updated successfully.');
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.workforce')->with('success', 'Employee deleted successfully.');
    }

    // Change employee status (Activate/Deactivate)
    public function changeStatus(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'status' => 'required|boolean',
        ]);

        $employee->status = $request->status;
        $employee->save();

        $statusText = $employee->status ? 'activated' : 'deactivated';

        return redirect()->route('admin.workforce')->with('success', "Employee {$statusText} successfully.");
    }
}
