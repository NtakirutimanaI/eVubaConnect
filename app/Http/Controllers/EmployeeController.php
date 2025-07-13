<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // List all employees with some stats
    public function index()
    {
        $employees = Employee::latest()->get();

        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 1)->count();
        $inactiveEmployees = Employee::where('status', 0)->count();

        return view('admin.employees', compact(
            'employees',
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees'
        ));
    }

    // Show form to create new employee (optional)
    public function create()
    {
        return view('admin.employees.create');
    }

    // Store new employee
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'nullable|string|max:255',
            'email'     => 'nullable|email|max:255|unique:employees,email',
            'status'    => 'required|boolean',
            'expertise' => 'nullable|string|max:255',
        ]);

        Employee::create($request->only([
            'name',
            'position',
            'email',
            'status',
            'expertise'
        ]));

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    // Show edit form
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'nullable|string|max:255',
            'email'     => 'nullable|email|max:255|unique:employees,email,' . $employee->id,
            'status'    => 'required|boolean',
            'expertise' => 'nullable|string|max:255',
        ]);

        $employee->update($request->only([
            'name',
            'position',
            'email',
            'status',
            'expertise'
        ]));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    // Optionally: A method to toggle status (activate/deactivate)
    public function changeStatus(Request $request, Employee $employee)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $employee->status = $request->status;
        $employee->save();

        $statusText = $employee->status ? 'activated' : 'deactivated';

        return redirect()->route('employees.index')->with('success', "Employee {$statusText} successfully.");
    }
}
