<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>eVubaConnect Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4fb;
      margin: 0;
    }

    .dashboard-container {
      width: 80.5%;
      margin-left: 240px;
      padding: 20px;
      margin-top: 50px;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 5px;
    }

    .subtitle {
      color: #888;
      margin-bottom: 20px;
    }

    .top-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .date-filter {
      background: white;
      padding: 15px 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .date-filter i {
      background: #e0f0ff;
      padding: 10px;
      border-radius: 8px;
      color: #1e88e5;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 20px;
      margin-top: 20px;
    }

    .box {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .box h2 {
      font-size: 20px;
      margin: 0 0 10px;
    }

    .value {
      font-weight: bold;
      font-size: 24px;
    }

    .green {
      color: #00b894;
    }

    .red {
      color: #d63031;
    }

    .card-row {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      flex: 1;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    canvas {
      width: 100% !important;
      height: 200px !important;
    }

    .placeholder {
      color: #aaa;
      text-align: center;
      padding: 60px 0;
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
      <div class="date-filter">
        <i class="fas fa-calendar-alt"></i>
        <div>
          <div><strong>Filter Periode</strong></div>
          <small>17 April 2020 - 21 May 2020</small>
        </div>
      </div>
    </div>

    <div class="card-row">
      <div class="card">
        <div class="value green">$276K</div>
        <div class="green">↑ 25%</div>
      </div>
      <div class="card">
        <div class="value red">$70.0K</div>
        <div class="red">↓ 25%</div>
      </div>
      <div class="card" style="flex: 2;">
        <canvas id="barChart"></canvas>
        <div style="text-align:center; margin-top: 10px;">
          <span class="green">■ Won Revenue</span> &nbsp;&nbsp;
          <span class="red">■ Lost Revenue</span>
        </div>
      </div>
      <div class="card" style="flex: 1.5;">
        <canvas id="pieChart"></canvas>
      </div>
    </div>

    <div class="grid" style="grid-template-columns: repeat(3, 1fr); margin-top: 20px;">
      <div class="box">
        <h2>Total Appointments<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box">
        <h2>Total Delivered<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box">
        <h2>Total Canceled<br>(30 Days)</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box">
        <h2>Total Quotations</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box">
        <h2>Total Persons</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
      <div class="box">
        <h2>Total Organizations</h2>
        <div class="value">0</div>
        <div class="green">↑ 0%</div>
      </div>
    </div>

    <div class="card-row" style="margin-top: 20px;">
      <div class="card" style="flex: 1;">
        <canvas id="orderChart"></canvas>
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
        }
      }
    });
  </script>

</body>
</html>
