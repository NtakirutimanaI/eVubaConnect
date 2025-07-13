<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Appointment;
use App\Models\Ticket; // For customer support
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $products = Product::all();
        $appointments = Appointment::all();
        $tickets = Ticket::all();

        return view('admin.reports', compact('employees', 'products', 'appointments', 'tickets'));
    }

    public function export($type)
    {
        if ($type == 'excel') {
            return Excel::download(new \App\Exports\FullReportExport, 'eVubaConnect_Report.xlsx');
        } elseif ($type == 'pdf') {
            $data = [
                'employees' => Employee::all(),
                'products' => Product::all(),
            ];
            $pdf = PDF::loadView('admin.exports.report_pdf', $data);
            return $pdf->download('eVubaConnect_Report.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }

    public function exportPdf()
{
    $data = ['title' => 'My PDF Report', 'date' => now()];
    $pdf = PDF::loadView('reports.my_pdf_view', $data);
    return $pdf->download('report.pdf');
}

}
