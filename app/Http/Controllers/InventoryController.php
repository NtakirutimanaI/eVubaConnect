<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductTransaction;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index()
    {
        $items = Product::with('supplier')->latest()->get();
        $suppliers = Supplier::all();

        // Inventory Stats
        $totalItems   = Product::count();
        $lowStock     = Product::whereColumn('quantity', '<=', 'min_threshold')->count();
        $outOfStock   = Product::where('quantity', '=', 0)->count();
        $recentItems  = Product::where('created_at', '>=', now()->subDays(7))->count();

        // Daily Sales Summary Stats
        $today = Carbon::today();

        $salesToday = ProductTransaction::where('transaction_type', 'sale')
            ->whereDate('created_at', $today)
            ->sum('total');

        $returnsToday = ProductTransaction::where('transaction_type', 'return')
            ->whereDate('created_at', $today)
            ->sum('total');

        $profitToday = $salesToday - $returnsToday;

        $transactionsToday = ProductTransaction::whereDate('created_at', $today)->count();

        return view('admin.inventory', compact(
            'items',
            'suppliers',
            'totalItems',
            'lowStock',
            'outOfStock',
            'recentItems',
            'salesToday',
            'returnsToday',
            'profitToday',
            'transactionsToday'
        ));
    }

    public function indexProducts()
    {
        $products = Product::with('supplier')->get();
        return view('products.index', compact('products'));
    }

    public function lowStock()
    {
        $products = Product::whereColumn('quantity', '<=', 'min_threshold')->with('supplier')->get();
        return view('products.low_stock', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'quantity'      => 'required|numeric|min:0',
            'min_threshold' => 'required|integer|min:0',
            'unit'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,id',
            'description'   => 'nullable|string',
        ]);

        Product::create($request->only([
            'name',
            'category',
            'quantity',
            'min_threshold',
            'unit',
            'price',
            'supplier_id',
            'description'
        ]));

        return redirect()->route('inventory.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('admin.inventory_edit', compact('product', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'quantity'      => 'required|numeric|min:0',
            'min_threshold' => 'required|integer|min:0',
            'unit'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,id',
            'description'   => 'nullable|string',
        ]);

        $product->update($request->only([
            'name',
            'category',
            'quantity',
            'min_threshold',
            'unit',
            'price',
            'supplier_id',
            'description'
        ]));

        return redirect()->route('inventory.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('inventory.index')->with('success', 'Product deleted successfully.');
    }

    public function restock(Request $request, Product $product)
    {
        $request->validate([
            'restock_quantity' => 'required|numeric|min:1'
        ]);

        $product->quantity += $request->restock_quantity;
        $product->save();

        return redirect()->route('inventory.index')->with('success', 'Product restocked successfully.');
    }
}
