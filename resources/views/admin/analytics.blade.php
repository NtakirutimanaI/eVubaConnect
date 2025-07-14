@include('admin.header') 
@include('admin.sidebar')
<title>Analytics Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        font-size: 11px;
         width: 80%;
         margin-left: 17.5%;
         margin-top:70px;
    }
    h2 {
        font-size: 18px;
    }
    .card {
        font-size: 11px;
    }
    .card-header {
        padding: 6px 12px;
        font-size: 12px;
    }
    .card-body {
        padding: 10px;
    }
    canvas {
        height: 160px !important;
    }
</style>

<div class="container mt-3">
    <h2 class="mb-3">Analytics Dashboard</h2>

    {{-- Workforce Performance Analytics --}}
    <div class="card mb-2">
        <div class="card-header bg-primary text-white">Workforce Performance</div>
        <div class="card-body">
            <canvas id="employeeTasksChart"></canvas>
            <p class="mt-1">Active vs. Inactive: <strong>{{ $activeEmployees }}/{{ $totalEmployees }}</strong></p>
            <p>Average Productivity Score: <strong>{{ $averageProductivity ?? '75%' }}</strong></p>
        </div>
    </div>

    {{-- Customer Engagement Analytics --}}
    <div class="card mb-2">
        <div class="card-header bg-success text-white">Customer Engagement</div>
        <div class="card-body">
            <canvas id="customerTicketsChart"></canvas>
            <p class="mt-1">Avg. Response Time: <strong>{{ $avgResponseTime ?? '4h 30min' }}</strong></p>
            <p>Chatbot Interactions Today: <strong>{{ $chatbotInteractionsToday ?? 0 }}</strong></p>
        </div>
    </div>

    {{-- Inventory & Asset Analytics --}}
    <div class="card mb-2">
        <div class="card-header bg-warning">Inventory Insights</div>
        <div class="card-body">
            <canvas id="stockCategoryChart"></canvas>
            <p class="mt-1">Low Stock Items: <strong>{{ $lowStockCount }}</strong></p>
        </div>
    </div>

    {{-- Appointment Analytics --}}
    <div class="card mb-2">
        <div class="card-header bg-info text-white">Appointments & Visits</div>
        <div class="card-body">
            <canvas id="weeklyVisitChart"></canvas>
            <p class="mt-1">No-Show Rate: <strong>{{ $noShowRate ?? '5%' }}</strong></p>
        </div>
    </div>

    {{-- Predictive Analytics --}}
    <div class="card mb-2">
        <div class="card-header bg-dark text-white">AI-Based Predictive Insights</div>
        <div class="card-body">
            <canvas id="stockForecastChart"></canvas>
            <p class="mt-1">Churn Risk (last 30 days): <strong>{{ $customerChurnRisk ?? 'Medium' }}</strong></p>
        </div>
    </div>
</div>

<script>
    const employeeTasksChart = new Chart(document.getElementById('employeeTasksChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($employeeNames) !!},
            datasets: [{
                label: 'Tasks Completed',
                data: {!! json_encode($tasksCompleted) !!},
                backgroundColor: 'rgba(0, 123, 255, 0.7)'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const customerTicketsChart = new Chart(document.getElementById('customerTicketsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($ticketDates) !!},
            datasets: [{
                label: 'Tickets',
                data: {!! json_encode($ticketCounts) !!},
                borderColor: 'rgba(40, 167, 69, 0.8)',
                fill: false
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const stockCategoryChart = new Chart(document.getElementById('stockCategoryChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($categories) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode($categoryCounts) !!},
                backgroundColor: ['#ffc107', '#28a745', '#dc3545', '#17a2b8']
            }]
        }
    });

    const weeklyVisitChart = new Chart(document.getElementById('weeklyVisitChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($visitWeekDays) !!},
            datasets: [{
                label: 'Visits',
                data: {!! json_encode($visitCounts) !!},
                borderColor: '#007bff',
                fill: true,
                backgroundColor: 'rgba(0, 123, 255, 0.1)'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const stockForecastChart = new Chart(document.getElementById('stockForecastChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($forecastDays) !!},
            datasets: [{
                label: 'Forecast',
                data: {!! json_encode($forecastData) !!},
                borderColor: '#343a40',
                fill: true,
                backgroundColor: 'rgba(52, 58, 64, 0.1)'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>



@include('admin.footer')