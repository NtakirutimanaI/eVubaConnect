@include('admin.header')
@include('admin.sidebar')

<div class="inventory-container">

    <div class="top-bar">
        <a href="{{ url('admin/inventory') }}" class="back-btn">← Back</a>
    </div>

    <h2 class="header-title">📦 Transactions Report</h2>
    @if(session('success'))
    <div style="background-color: #d4edda; padding: 10px; color: #155724; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #f8d7da; padding: 10px; color: #721c24; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif


    {{-- Filter --}}
    <form method="GET" action="{{ route('transactions.index') }}" class="filter-form" style="margin-bottom: 15px;">
        <label for="from">From:</label>
        <input type="date" name="from" value="{{ request('from') }}" />
        <label for="to">To:</label>
        <input type="date" name="to" value="{{ request('to') }}" />
        <button type="submit" class="add-btn">Filter</button>
    </form>

    <a href="{{ route('transactions.export') }}" class="add-btn export-btn" style="margin-bottom: 20px;">
        Export Transactions to Excel
    </a>

    {{-- Summary --}}
    <div class="stats-grid">
        <div class="card"><h4>Total Sales Today</h4><p>RWF {{ number_format($salesToday, 2) }}</p></div>
        <div class="card"><h4>Returns Today</h4><p>RWF {{ number_format($returnsToday, 2) }}</p></div>
        <div class="card"><h4>Profit Today</h4><p>RWF {{ number_format($profitToday, 2) }}</p></div>
        <div class="card"><h4>Transactions Today</h4><p>{{ $transactionsToday }}</p></div>
    </div>

    {{-- Pagination --}}
    <div class="pagination-container" style="margin-bottom: 10px;">
        <label for="itemsPerPage">Items per page:</label>
        <select id="itemsPerPage" onchange="setupPagination()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
        </select>
        <div class="pagination" id="pagination" style="display:inline-block; margin-left: 10px;"></div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
                <th>Type</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @forelse($transactions as $trx)
                <tr>
                    <td>{{ $trx->client->full_name ?? 'N/A' }}</td>
                    <td>{{ $trx->product->name ?? 'N/A' }}</td>
                    <td>{{ $trx->quantity }}</td>
                    <td>{{ number_format($trx->price, 2) }}</td>
                    <td>{{ number_format($trx->total, 2) }}</td>
                    <td>{{ ucfirst($trx->transaction_type) }}</td>
                    <td>{{ ucfirst($trx->status) }}</td>
                    <td>{{ $trx->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="8" style="text-align: center;">No transactions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.footer')

{{-- Include CSS --}}
<style>
    {{ $yourCSS = <<<'CSS'
    body {
        background: #f4f6f8;
        font-family: Arial, sans-serif;
        margin-top: 105px;
        margin-bottom: 25px;
        font-size: 12px;
        color: #2c3e50;
    }
    .inventory-container {
        width: 81.5%;
        margin-left: 17.5%;
        margin-top: 10px;
        position: relative;
        font-size: 12px;
    }

    /* Top Bar */
    .top-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 5px;
    }
    .back-btn {
        background-color: #6c757d;
        color: white;
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .back-btn:hover {
        background-color: #5a6268;
    }

    .header-title {
        font-size: 18px;
        margin-top: 10px;
        margin-bottom: 20px;
        color: #2c3e50;
        font-weight: 600;
    }

    form.filter-form label {
        margin-right: 6px;
        font-weight: 600;
        font-size: 12px;
        color: #444;
    }
    form.filter-form input[type="date"] {
        padding: 4px 6px;
        font-size: 12px;
        margin-right: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        vertical-align: middle;
    }
    form.filter-form button.add-btn {
        background-color: #007bff;
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.25s ease;
        vertical-align: middle;
        color: white;
    }
    form.filter-form button.add-btn:hover {
        background-color: #0056b3;
    }

    .add-btn.export-btn {
        background-color: #28a745 !important;
        display: inline-block;
        padding: 8px 18px;
        color: white;
        font-size: 13px;
        border-radius: 6px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.25s ease;
    }
    .add-btn.export-btn:hover {
        background-color: #1e7e34 !important;
    }

    .stats-grid {
        display: flex;
        gap: 16px;
        margin-bottom: 80px;
        flex-wrap: wrap;
    }
    .card {
        background: white;
        border-radius: 8px;
        padding: 15px 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        flex: 1 1 180px;
        min-width: 180px;
        text-align: center;
        font-size: 13px;
        color: #34495e;
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .card h4 {
        margin: 0 0 10px 0;
        font-weight: 600;
        color: #2c3e50;
    }
    .card p {
        font-size: 20px;
        font-weight: 700;
        color: #27ae60;
        margin: 0;
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        font-size: 12px;
    }
    th, td {
        padding: 8px 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background: #007bff;
        color: white;
        font-weight: 600;
        font-size: 13px;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
    tr:hover {
        background-color: #e6f2ff;
    }

    .pagination button {
        background: #f0f0f0;
        border: 1px solid #ddd;
        margin: 0 2px;
        padding: 4px 8px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 12px;
    }
    .pagination button.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    @media (max-width: 1024px) {
        .inventory-container {
            width: 90%;
            margin-left: 5%;
            font-size: 11px;
        }
        .add-btn, form.filter-form button.add-btn {
            font-size: 11px;
            padding: 5px 10px;
        }
    }
    @media (max-width: 768px) {
        .inventory-container {
            width: 95%;
            margin-left: 2.5%;
            font-size: 11px;
        }
        .add-btn {
            width: 100%;
            font-size: 12px;
        }
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        .stats-grid {
            flex-direction: column;
        }
        .card {
            width: 100%;
            margin-bottom: 12px;
        }
        .pagination-container {
            justify-content: flex-start;
            gap: 5px;
            flex-wrap: wrap;
        }
    }
    CSS }}
    {!! $yourCSS !!}
</style>

{{-- Script --}}
<script>
    let current_page = 1;
    let rows_per_page = 10;

    const itemsPerPageSelect = document.getElementById('itemsPerPage');
    const pagination = document.getElementById('pagination');

    function displayRows() {
        const tbody = document.getElementById('tableBody');
        const rows = tbody.getElementsByTagName('tr');
        let start = (current_page - 1) * rows_per_page;
        let end = start + rows_per_page;
        for(let i = 0; i < rows.length; i++) {
            rows[i].style.display = (i >= start && i < end) ? '' : 'none';
        }
    }

    function setupPagination() {
        rows_per_page = parseInt(itemsPerPageSelect.value);
        current_page = 1;
        displayRows();

        pagination.innerHTML = '';
        const tbody = document.getElementById('tableBody');
        const rows = tbody.getElementsByTagName('tr');
        let page_count = Math.ceil(rows.length / rows_per_page);

        for(let i = 1; i <= page_count; i++) {
            let btn = document.createElement('button');
            btn.innerText = i;
            if(i === current_page) btn.classList.add('active');
            btn.addEventListener('click', function() {
                current_page = i;
                displayRows();
                updatePaginationButtons();
            });
            pagination.appendChild(btn);
        }
    }

    function updatePaginationButtons() {
        const buttons = pagination.querySelectorAll('button');
        buttons.forEach((btn, idx) => {
            btn.classList.toggle('active', idx + 1 === current_page);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupPagination();
    });
</script>
