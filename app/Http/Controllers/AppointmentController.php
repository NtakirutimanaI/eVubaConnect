<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('web.appointment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'nullable|string|max:255',
            'date'       => 'nullable|date',
            'from_time'  => 'nullable',
            'to_time'    => 'nullable',
            'timezone'   => 'nullable|string',
            'location'   => 'nullable|string|max:255',
            'day'        => 'nullable|string',
        ]);

        Appointment::create($request->all());

        return redirect()->back()->with('success', 'Appointment saved successfully.');
    }

    // Add this to AppointmentController
     public function create()
     {
         return view('web.appointment');
     }

}
