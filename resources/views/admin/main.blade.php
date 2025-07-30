<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>eVubaConnect Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    :root {
      --spacing: 20px;
      --border-radius: 12px;
      --card-bg: #fff;
      --shadow: 0 0 10px rgba(0,0,0,0.05);
      --green: #00b894;
      --red: #d63031;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f4fb;
      color: #222;
      margin-left:222px;
    }

    .dashboard-container {
      max-width: 900px;
      margin: 50px auto 40px;
      padding: 0 var(--spacing);
    }

    h1 {
      font-size: 28px;
      margin-bottom: 4px;
      font-weight: 700;
      color: #333;
    }

    .subtitle {
      color: #666;
      margin-bottom: var(--spacing);
      font-weight: 500;
      font-size: 14px;
    }

    .top-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: var(--spacing);
      margin-bottom: var(--spacing);
    }

    .date-filter {
      background: var(--card-bg);
      padding: 15px 20px;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 220px;
      flex-shrink: 0;
    }

    .date-filter i {
      font-size: 24px;
      color: #1e88e5;
      background: #e0f0ff;
      padding: 10px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Cards row (summary + charts) */
    .card-row {
      display: flex;
      gap: var(--spacing);
      flex-wrap: wrap;
      margin-bottom: var(--spacing);
    }

    .card {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      padding: 20px;
      flex: 1 1 250px;
      min-width: 250px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* Fixed widths for charts to keep proportion */
    .card.chart-bar {
      flex: 2 1 520px;
      min-width: 320px;
    }

    .card.chart-pie {
      flex: 1 1 320px;
      min-width: 280px;
    }

    .card h2 {
      font-size: 20px;
      margin: 0 0 12px;
      font-weight: 600;
      color: #333;
    }

    .value {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 6px;
      color: var(--green);
    }

    .value.red {
      color: var(--red);
    }

    .green {
      color: var(--green);
      font-weight: 600;
      font-size: 14px;
    }

    .red {
      color: var(--red);
      font-weight: 600;
      font-size: 14px;
    }

    /* Grid for info boxes */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: var(--spacing);
    }

    .box {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      padding: 20px;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .box h2 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      line-height: 1.2;
      color: #444;
    }

    .box .value {
      font-size: 26px;
      margin-bottom: 8px;
      font-weight: 700;
      color: var(--green);
    }

    /* Chart canvas sizing */
    canvas {
      width: 100% !important;
      height: 220px !important;
      display: block;
    }

    /* Legend below bar chart */
    .legend {
      margin-top: 12px;
      text-align: center;
      font-size: 14px;
      color: #555;
      user-select: none;
    }

    .legend span {
      margin: 0 10px;
      font-weight: 600;
    }

    .legend .green-box {
      color: var(--green);
    }

    .legend .red-box {
      color: var(--red);
    }

    /* Responsive tweaks */
    @media (max-width: 900px) {
      .dashboard-container {
        margin: 30px auto 30px;
        padding: 0 15px;
      }

      .top-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .date-filter {
        min-width: auto;
        width: 100%;
        justify-content: center;
      }

      .card-row {
        flex-direction: column;
      }

      .card.chart-bar,
      .card.chart-pie {
        flex: 1 1 100%;
        min-width: auto;
      }

      .value {
        font-size: 24px;
      }

      .box h2 {
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 22px;
      }

      .subtitle {
        font-size: 13px;
      }

      .value {
        font-size: 20px;
      }

      .box h2 {
        font-size: 15px;
      }

      .date-filter {
        flex-direction: column;
        gap: 6px;
      }

      .date-filter i {
        font-size: 20px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <div class="top-row">
      <div>
        <h1>Dashboard</h1>
        <div class="subtitle">Welcome to eVubaConnect Admin!</div>
      </div>
      <div class="date-filter" aria-label="Date filter period">
        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
        <div>
          <div><strong>Filter Periode</strong></div>
          <small>17 April 2020 - 21 May 2020</small>
        </div>
      </div>
    </div>

    <div class="card-row" role="region" aria-label="Summary cards and charts">
      <div class="card" role="article" aria-label="Won Revenue">
        <div class="value green">$276K</div>
        <div class="green">↑ 25%</div>
      </div>
      <div class="card" role="article" aria-label="Lost Revenue">
        <div class="value red">$70.0K</div>
        <div class="red">↓ 25%</div>
      </div>
      <div class="card chart-bar" role="article" aria-label="Won and Lost Revenue Bar Chart">
        <canvas id="barChart" aria-label="Bar chart showing won and lost revenue" role="img"></canvas>
        <div class="legend">
          <span class="green-box">■ Won Revenue</span>
          <span class="red-box">■ Lost Revenue</span>
        </div>
      </div>
      <div class="card chart-pie" role="article" aria-label="Revenue Distribution Pie Chart">
        <canvas id="pieChart" aria-label="Pie chart showing revenue distribution" role="img"></canvas>
      </div>
    </div>

    <div class="grid" role="region" aria-label="Summary statistics">
      <div class="box" role="article" aria-label="Total Appointments in 30 Days">
        <h2>Total Appointments<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box" role="article" aria-label="Total Delivered in 30 Days">
        <h2>Total Delivered<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box" role="article" aria-label="Total Canceled in 30 Days">
        <h2>Total Canceled<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box" role="article" aria-label="Total Quotations">
        <h2>Total Quotations</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box" role="article" aria-label="Total Persons">
        <h2>Total Persons</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box" role="article" aria-label="Total Organizations">
        <h2>Total Organizations</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
    </div>

    <div class="card-row" style="margin-top: var(--spacing);" role="region" aria-label="Order chart">
      <div class="card" role="article" aria-label="Order Line Chart">
        <canvas id="orderChart" aria-label="Line chart showing orders over weeks" role="img"></canvas>
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script>
    // Bar Chart
    new Chart(document.getElementById("barChart"), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [
          {
            label: 'Won Revenue',
            data: [50, 70, 80, 60, 90],
            backgroundColor: '#00b894'
          },
          {
            label: 'Lost Revenue',
            data: [30, 40, 20, 50, 10],
            backgroundColor: '#d63031'
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        },
        plugins: {
          legend: { display: false }
        }
      }
    });

    // Pie Chart
    new Chart(document.getElementById("pieChart"), {
      type: 'pie',
      data: {
        labels: ['Won', 'Lost', 'Pending'],
        datasets: [{
          data: [60, 25, 15],
          backgroundColor: ['#00b894', '#d63031', '#fdcb6e']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });

    // Order Chart
    new Chart(document.getElementById("orderChart"), {
      type: 'line',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'Orders',
          data: [10, 20, 15, 25],
          borderColor: '#0984e3',
          fill: false,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        },
        plugins: {
          legend: { display: false }
        }
      }
    });
  </script>

</body>
</html>
