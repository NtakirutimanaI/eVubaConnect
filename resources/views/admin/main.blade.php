<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="wrapper">
    <div class="main-1">
    <div class="container">
    <div class="revenue-section">
    <div class="revenue-cards">
        <!-- Revenue Won -->
        <div class="revenue-card won">
            <p class="label">Revenue Won</p>
            <h2>$276K</h2>
            <span class="change up">↑ 25%</span>
        </div>

        <!-- Revenue Lost -->
        <div class="revenue-card lost">
            <p class="label">Revenue Lost</p>
            <h2>$70.0K</h2>
            <span class="change down">↓ 25%</span>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="revenueChart"></canvas>
        <div class="chart-legend">
            <span><span class="legend-color won-color"></span> Won Revenue</span>
            <span><span class="legend-color lost-color"></span> Lost Revenue</span>
        </div>
    </div>
</div>


<div class="stats-grid">
    <!-- Row 1 -->
    <div class="stat-card">
        <p class="stat-label">Total Appointments</p>
        <h2 class="stat-value">(30 Days)</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Delivered</p>
        <h2 class="stat-value">(30 Days)</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Canceled</p>
        <h2 class="stat-value">(30 Days)</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>

    <!-- Row 2 -->
    <div class="stat-card">
        <p class="stat-label">Total Quotations</p>
        <h2 class="stat-value">0</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Persons</p>
        <h2 class="stat-value">0</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>

    <div class="stat-card">
        <p class="stat-label">Total Organizations</p>
        <h2 class="stat-value">0</h2>
        <span class="stat-change up">↑ 0%</span>
    </div>
</div>

</div>
</div>

<div class="main-2">
    <div class="pie"> Pie Charts</div>
    <div class="chart-order">Chart Order</div>
</div>

</div>

@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection

