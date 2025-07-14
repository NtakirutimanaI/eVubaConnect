@include('admin.header')
@include('admin.sidebar')

<title>eVubaConnect Reports</title>

<style>
    .report-wrapper {
        margin-left: 17.5%;
        padding: 40px 30px;
        background-color: #f9fbfc;
        min-height: 100vh;
        color: #2d3748;
        font-family: 'Segoe UI', sans-serif;
    }

    .report-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .action-links {
        margin-bottom: 25px;
    }

    .action-button {
        background-color: #1f8b4c;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        margin-right: 12px;
        text-decoration: none;
        font-size: 13px;
        transition: background-color 0.3s ease;
    }

    .action-button.pdf {
        background-color: #c0392b;
    }

    .action-button:hover {
        opacity: 0.9;
    }

    .report-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .report-box {
        flex: 1 1 45%;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 20px;
        min-height: 130px;
    }

    .report-box h6 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #2c3e50;
    }

    .report-box ul {
        padding-left: 20px;
        list-style-type: disc;
        max-height: 150px;
        overflow-y: auto;
    }

    .report-box ul li {
        margin-bottom: 6px;
        font-size: 13px;
    }

    .report-box p {
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }

    @media (max-width: 768px) {
        .report-wrapper {
            margin-left: 0;
            padding: 20px;
        }

        .report-box {
            flex: 1 1 100%;
        }
    }
</style>

<div class="report-wrapper">
    <h4 class="report-title">📊 System Reports</h4>

    <div class="action-links">
        <a href="{{ route('admin.reports.export', 'excel') }}" class="action-button">Export Excel</a>
        <a href="{{ route('admin.reports.export', 'pdf') }}" class="action-button pdf">Export PDF</a>
    </div>

    <div class="report-grid">
        <div class="report-box">
            <h6>👨‍💼 Employee Performance</h6>
            <ul>
                @foreach($employees as $emp)
                    <li>{{ $emp->name }} – Tasks Done: {{ $emp->tasks_done ?? 0 }}</li>
                @endforeach
            </ul>
        </div>

        <div class="report-box">
            <h6>📦 Inventory Summary</h6>
            <ul>
                @foreach($products as $product)
                    <li>{{ $product->name }} – Qty: {{ $product->quantity }}</li>
                @endforeach
            </ul>
        </div>

        <div class="report-box">
            <h6>📅 Appointments</h6>
            <p>Total Visits: {{ $appointments->count() }}</p>
        </div>

        <div class="report-box">
            <h6>💬 Customer Tickets</h6>
            <p>Total Tickets: {{ $tickets->count() }}</p>
        </div>
    </div>
</div>

@include('admin.footer')
