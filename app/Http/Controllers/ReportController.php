<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Appointment;
use App\Models\Ticket;
use App\Models\ProductTransaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FullReportExport;
use App\Exports\TransactionsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the report dashboard with optional date filtering for transactions.
     */
    public function index(Request $request)
    {
        // Fetch other entities
        $employees = Employee::all();
        $products = Product::all();
        $appointments = Appointment::all();
        $tickets = Ticket::all();

        // Transactions query with optional date filtering
        $query = ProductTransaction::query();

        if ($request->has(['from', 'to'])) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        // Load relations for transactions
        $transactions = $query->with(['product', 'client'])->latest()->get();

        // Pass all data to the view
        return view('admin.reports', compact(
            'employees',
            'products',
            'appointments',
            'tickets',
            'transactions'
        ));
    }

    /**
     * Export the full report as Excel or PDF.
     */
    public function export($type)
    {
        if ($type === 'excel') {
            return Excel::download(new FullReportExport, 'eVubaConnect_Report.xlsx');
        } elseif ($type === 'pdf') {
            $data = [
                'employees' => Employee::all(),
                'products' => Product::all(),
                'appointments' => Appointment::all(),
                'tickets' => Ticket::all(),
                'transactions' => ProductTransaction::with(['product', 'client'])->get(),
            ];
            $pdf = Pdf::loadView('admin.exports.report_pdf', $data);
            return $pdf->download('eVubaConnect_Report.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }

    /**
     * Export only transaction data to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }

    /**
     * Export a basic sample PDF report.
     */
    public function exportPdf()
    {
        $data = [
            'title' => 'My PDF Report',
            'date' => now()
        ];
        $pdf = Pdf::loadView('reports.my_pdf_view', $data);
        return $pdf->download('report.pdf');
    }
}
