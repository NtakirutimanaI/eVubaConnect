<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\ProductTransaction;
use App\Models\Product;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource along with daily summary.
     */
    public function index(Request $request)
    {
        $query = ProductTransaction::query();

        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        $transactions = $query->with(['product', 'client'])->latest()->get();
        $today = Carbon::today();

        $salesToday = ProductTransaction::where('transaction_type', 'sale')
            ->whereDate('created_at', $today)->sum('total');

        $returnsToday = ProductTransaction::where('transaction_type', 'return')
            ->whereDate('created_at', $today)->sum('total');

        $profitToday = $salesToday - $returnsToday;

        $transactionsToday = ProductTransaction::whereDate('created_at', $today)->count();

        return view('admin.transactions', compact(
            'transactions', 'salesToday', 'returnsToday', 'profitToday', 'transactionsToday'
        ));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();

        return view('admin.transactions.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created transaction in storage with error handling.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'client_full_name' => 'required|string|max:255',
                'client_email'     => 'nullable|email|max:255|unique:clients,email',
                'client_phone'     => 'nullable|string|max:20',
                'client_company'   => 'nullable|string|max:255',
                'client_address'   => 'nullable|string|max:255',

                'product_id'       => 'required|exists:products,id',
                'quantity'         => 'required|numeric|min:0',
                'price'            => 'required|numeric|min:0',
                'transaction_type' => 'required|in:sale,return',
                'status'           => 'required|in:pending,delivered,cancelled,returned',
                'notes'            => 'nullable|string',
            ]);

            // Create client
            $client = Client::create([
                'full_name' => $request->client_full_name,
                'email'     => $request->client_email,
                'phone'     => $request->client_phone,
                'company'   => $request->client_company,
                'address'   => $request->client_address,
            ]);

            // Create transaction
            ProductTransaction::create([
                'product_id'       => $request->product_id,
                'client_id'        => $client->id,
                'quantity'         => $request->quantity,
                'price'            => $request->price,
                'total'            => $request->quantity * $request->price,
                'transaction_type' => $request->transaction_type,
                'status'           => $request->status,
                'notes'            => $request->notes,
            ]);

            return redirect()->route('transactions.index')->with('success', 'Transaction and Client saved successfully.');

        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'The email provided is already registered.');
            }

            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while saving the transaction.');
        }
    }

    /**
     * Display the specified transaction.
     */
    public function show($id)
    {
        $transaction = ProductTransaction::with(['product', 'client'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Generate a PDF invoice for a transaction.
     */
    public function generateInvoice($id)
    {
        $transaction = ProductTransaction::with(['client', 'product'])->findOrFail($id);
        $pdf = Pdf::loadView('admin.transactions.invoice', compact('transaction'));
        return $pdf->download('invoice_' . $transaction->id . '.pdf');
    }

    /**
     * Daily report summary (view only).
     */
    public function summary()
    {
        $today = Carbon::today();

        $salesToday = ProductTransaction::where('transaction_type', 'sale')
            ->whereDate('created_at', $today)->sum('total');

        $returnsToday = ProductTransaction::where('transaction_type', 'return')
            ->whereDate('created_at', $today)->sum('total');

        $profitToday = $salesToday - $returnsToday;

        $transactionsToday = ProductTransaction::whereDate('created_at', $today)->count();

        return view('admin.reports.summary', compact(
            'salesToday', 'returnsToday', 'profitToday', 'transactionsToday'
        ));
    }

    /**
     * Monthly grouped report view.
     */
    public function monthlyReport()
    {
        $monthly = ProductTransaction::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, transaction_type, SUM(total) as total')
            ->groupBy('year', 'month', 'transaction_type')
            ->orderByRaw('year DESC, month DESC')
            ->get()
            ->groupBy('transaction_type');

        return view('admin.reports.monthly', compact('monthly'));
    }

    /**
     * Top clients and products based on sales.
     */
    public function topStats()
    {
        $topClients = ProductTransaction::with('client')
            ->where('transaction_type', 'sale')
            ->selectRaw('client_id, SUM(total) as total_spent')
            ->groupBy('client_id')
            ->orderByDesc('total_spent')
            ->take(5)->get();

        $topProducts = ProductTransaction::with('product')
            ->where('transaction_type', 'sale')
            ->selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)->get();

        return view('admin.reports.top', compact('topClients', 'topProducts'));
    }

    /**
     * Calculate overall profit.
     */
    public function calculateProfit()
    {
        $sales = ProductTransaction::where('transaction_type', 'sale')
            ->with('product')->get();

        $profit = $sales->sum(function ($trx) {
            $cost = $trx->product->cost_price ?? 0;
            return ($trx->price - $cost) * $trx->quantity;
        });

        return $profit;
    }

    /**
     * Export transactions to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }

    /**
     * Delete a transaction.
     */
    public function destroy($id)
    {
        $trx = ProductTransaction::findOrFail($id);
        $trx->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}
