<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class SchedulingController extends Controller
{
    public function index()
    {
        // Get all schedules ordered by time and group them by day
        $schedules = Schedule::orderBy('time')->get()->groupBy('day');

        $scheduleData = [];

        foreach ($schedules as $day => $events) {
            // Map the events for each day to a simplified array
            $scheduleData[$day] = $events->map(function ($event) {
                return [
                    'time' => date('H:i', strtotime($event->time)),
                    'customer' => $event->customer,
                    'status' => $event->status,
                    'priority' => $event->priority,
                ];
            })->toArray();
        }

        return view('admin.scheduling', compact('scheduleData'));
    }

    public function create()
    {
        return view('admin.scheduling_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'time' => 'required',
            'customer' => 'required|string',
            'status' => 'required|in:Completed,Scheduled',
            'priority' => 'required|in:Low,High',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.scheduling')->with('success', 'Schedule created.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.scheduling_edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'day' => 'required|string',
            'time' => 'required',
            'customer' => 'required|string',
            'status' => 'required|in:Completed,Scheduled',
            'priority' => 'required|in:Low,High',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.scheduling')->with('success', 'Schedule updated.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.scheduling')->with('success', 'Schedule deleted.');
    }

    // Your new auto scheduling method:
    public function auto(Request $request)
    {
        // Fetch existing schedules
        $schedules = Schedule::all();

        // Define times and days
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $times = ['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '16:00', '18:00'];

        // Find first free slot and assign one schedule
        foreach ($days as $day) {
            foreach ($times as $time) {
                $exists = $schedules->where('day', $day)->where('time', $time)->count();
                if ($exists == 0) {
                    Schedule::create([
                        'day' => $day,
                        'time' => $time,
                        'customer' => 'Auto Assigned',
                        'status' => 'Scheduled',
                        'priority' => 'Low',
                    ]);
                    break 2; // Assign only one slot then stop
                }
            }
        }

        return redirect()->back()->with('success', 'Auto scheduling completed!');
    }
}
