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
     * Show the report dashboard or detailed invoice view.
     * Passes $report to fix undefined variable error in invoice Blade.
     */
    public function index(Request $request)
    {
        $employees = Employee::all();
        $products = Product::all();
        $appointments = Appointment::all();
        $tickets = Ticket::all();

        $query = ProductTransaction::query();

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $transactions = $query->with(['product', 'client'])->latest()->get();

        // Create a sample $report object to avoid undefined variable error
        $report = (object)[
            'invoice_no' => '241756',
            'billing_name' => 'Walters',
            'billing_address' => '200 Wilmot Rd, Deerfield, IL 60015',
            'shipping_name' => 'Walters',
            'shipping_address' => '1720 W La Palma Ave, Anaheim, CA 83709',
            'items' => [
                (object)['description' => 'SuperLED 42', 'unit_price' => 1050, 'quantity' => 2, 'discount' => 50, 'total' => 2050],
                (object)['description' => 'SuperLED 50', 'unit_price' => 1100, 'quantity' => 5, 'discount' => 500, 'total' => 5000],
                (object)['description' => 'Projector PlusHD', 'unit_price' => 600, 'quantity' => 5, 'discount' => 250, 'total' => 2750],
                (object)['description' => 'HD Video Player', 'unit_price' => 220, 'quantity' => 10, 'discount' => 0, 'total' => 2000],
            ],
            'subtotal' => 11800,
            'shipping' => 375,
            'total' => 12175,
        ];

        return view('admin.reports', compact(
            'employees',
            'products',
            'appointments',
            'tickets',
            'transactions',
            'report'   // Pass report here!
        ));
    }

    /**
     * Export the full report as Excel or PDF.
     */
    public function export($type)
    {
        if ($type === 'excel') {
            return Excel::download(new FullReportExport, 'eVubaConnect_Report.xlsx');
        }

        if ($type === 'pdf') {
            // Build the same $report object for PDF export
            $report = (object)[
                'invoice_no' => '241756',
                'billing_name' => 'Walters',
                'billing_address' => '200 Wilmot Rd, Deerfield, IL 60015',
                'shipping_name' => 'Walters',
                'shipping_address' => '1720 W La Palma Ave, Anaheim, CA 83709',
                'items' => [
                    (object)['description' => 'SuperLED 42', 'unit_price' => 1050, 'quantity' => 2, 'discount' => 50, 'total' => 2050],
                    (object)['description' => 'SuperLED 50', 'unit_price' => 1100, 'quantity' => 5, 'discount' => 500, 'total' => 5000],
                    (object)['description' => 'Projector PlusHD', 'unit_price' => 600, 'quantity' => 5, 'discount' => 250, 'total' => 2750],
                    (object)['description' => 'HD Video Player', 'unit_price' => 220, 'quantity' => 10, 'discount' => 0, 'total' => 2000],
                ],
                'subtotal' => 11800,
                'shipping' => 375,
                'total' => 12175,
            ];

            $data = [
                'employees' => Employee::all(),
                'products' => Product::all(),
                'appointments' => Appointment::all(),
                'tickets' => Ticket::all(),
                'transactions' => ProductTransaction::with(['product', 'client'])->get(),
                'report' => $report,
            ];

            return Pdf::loadView('admin.exports.report_pdf', $data)
                      ->setPaper('a4')
                      ->download('eVubaConnect_Report.pdf');
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
     * Export a standalone sample PDF report.
     */
    public function exportPdf()
    {
        $report = (object)[
            'invoice_no' => '241756',
            'billing_name' => 'Walters',
            'billing_address' => '200 Wilmot Rd, Deerfield, IL 60015',
            'shipping_name' => 'Walters',
            'shipping_address' => '1720 W La Palma Ave, Anaheim, CA 83709',
            'items' => [
                (object)['description' => 'SuperLED 42', 'unit_price' => 1050, 'quantity' => 2, 'discount' => 50, 'total' => 2050],
                (object)['description' => 'SuperLED 50', 'unit_price' => 1100, 'quantity' => 5, 'discount' => 500, 'total' => 5000],
                (object)['description' => 'Projector PlusHD', 'unit_price' => 600, 'quantity' => 5, 'discount' => 250, 'total' => 2750],
                (object)['description' => 'HD Video Player', 'unit_price' => 220, 'quantity' => 10, 'discount' => 0, 'total' => 2000],
            ],
            'subtotal' => 11800,
            'shipping' => 375,
            'total' => 12175,
        ];

        return Pdf::loadView('reports.my_pdf_view', [
            'title' => 'My PDF Report',
            'date' => now(),
            'report' => $report,
        ])->download('report.pdf');
    }
}
