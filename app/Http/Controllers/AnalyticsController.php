<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Visit;
use Illuminate\Support\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Workforce Performance Analytics
        $employees = Employee::all();
        $employeeNames = $employees->pluck('name');
        $tasksCompleted = $employees->map(fn($e) => rand(5, 15)); // Replace with actual task count logic
        $activeEmployees = $employees->where('status', 1)->count();
        $totalEmployees = $employees->count();
        $averageProductivity = '75%'; // Replace with calculated average if available

        // Customer Engagement Analytics
        $ticketDates = collect(range(-6, 0))->map(fn($d) => Carbon::now()->addDays($d)->format('D'));
        $ticketCounts = collect(range(1, 7))->map(fn() => rand(3, 10)); // Replace with real data
        $avgResponseTime = '4h 30min';
        $chatbotInteractionsToday = rand(5, 20); // Replace with real logs

        // Inventory & Asset Analytics
        $categories = ['Fertilizers', 'Seeds', 'Tools', 'Chemicals'];
        $categoryCounts = [10, 15, 8, 6]; // Replace with DB aggregate counts
        $lowStockCount = Product::whereColumn('quantity', '<', 'min_threshold')->count();

        // Appointment Analytics
        $visitWeekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $visitCounts = [3, 5, 2, 4, 6, 1, 0]; // Replace with real data
        $noShowRate = '5%';

        // Predictive Analytics
        $forecastDays = ['Today', '+1d', '+2d', '+3d', '+4d', '+5d'];
        $forecastData = [100, 95, 90, 85, 80, 78]; // Replace with ML-predicted data
        $customerChurnRisk = 'Medium';

        return view('admin.analytics', compact(
            'employeeNames',
            'tasksCompleted',
            'activeEmployees',
            'totalEmployees',
            'averageProductivity',
            'ticketDates',
            'ticketCounts',
            'avgResponseTime',
            'chatbotInteractionsToday',
            'categories',
            'categoryCounts',
            'lowStockCount',
            'visitWeekDays',
            'visitCounts',
            'noShowRate',
            'forecastDays',
            'forecastData',
            'customerChurnRisk'
        ));
    }
}
