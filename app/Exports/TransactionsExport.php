<?php

namespace App\Exports;

use App\Models\ProductTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch all product transactions with relationships.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProductTransaction::with('product', 'client')->get();
    }

    /**
     * Define the column headings in the exported Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'Client Name',
            'Transaction Type',
            'Quantity',
            'Total',
            'Date',
        ];
    }

    /**
     * Map the data for each row.
     *
     * @param \App\Models\ProductTransaction $transaction
     * @return array
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->product->name ?? 'N/A',
            $transaction->client->name ?? 'N/A',
            ucfirst($transaction->transaction_type),
            $transaction->quantity,
            $transaction->total,
            $transaction->created_at->format('Y-m-d'),
        ];
    }
}
