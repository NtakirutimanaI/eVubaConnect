@include('admin.header') 
@include('admin.sidebar')<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sales CRM Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f5f5;
      margin: 0;
    }

    .dashboard-container {
      width: 81.5%;
      margin-left: 222px;
      padding: 20px;
    }

    h2 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: auto auto;
      gap: 20px;
    }

    .card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .big-number {
      font-size: 36px;
      font-weight: bold;
    }

    .percent-green {
      color: #28a745;
      font-weight: bold;
    }

    .bar-names {
      margin-top: 15px;
    }

    .bar-names div {
      display: flex;
      justify-content: space-between;
      margin: 5px 0;
    }

    .bar {
      height: 12px;
      border-radius: 4px;
      margin: 5px 0;
    }

    .bar.yellow { background: #fcd34d; }
    .bar.blue { background: #60a5fa; }
    .bar.red { background: #f87171; }
    .bar.green { background: #34d399; }

    canvas {
      width: 100% !important;
      height: 200px !important;
    }

    .map-placeholder {
      background: #e0e0e0;
      height: 200px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #888;
      font-weight: bold;
    }

  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>Sales CRM Dashboard</h2>

    <div class="grid">

      <!-- Opportunities Created -->
      <div class="card">
        <p>Opportunities Created</p>
        <div class="big-number">1,146</div>
        <div class="percent-green">+276%</div>
        <small>vs same month last year</small>
      </div>

      <!-- Opportunity Amount vs Created -->
      <div class="card">
        <p>Opportunity Amount vs Created</p>
        <canvas id="opportunityChart"></canvas>
      </div>

      <!-- Opportunity Amount by Stage -->
      <div class="card">
        <p>Opportunity Amount by Stage</p>
        <canvas id="stageChart"></canvas>
      </div>

      <!-- Won Opportunities by Rep -->
      <div class="card">
        <p>Won Opportunities by Rep</p>
        <div class="bar-names">
          <div><span>Alda Daffey</span> <span>30,586</span></div>
          <div class="bar yellow" style="width: 100%;"></div>

          <div><span>Arlen Brecher</span> <span>4,222</span></div>
          <div class="bar blue" style="width: 13%;"></div>

          <div><span>Benoit Canstad</span> <span>21,662</span></div>
          <div class="bar yellow" style="width: 70%;"></div>

          <div><span>Byrn Duchart</span> <span>21,462</span></div>
          <div class="bar blue" style="width: 69%;"></div>

          <div><span>Carees Preist</span> <span>21,601</span></div>
          <div class="bar blue" style="width: 70%;"></div>

          <div><span>Demetri Yakubovich</span> <span>20,979</span></div>
          <div class="bar yellow" style="width: 68%;"></div>

          <div><span>Dunc Ahwell</span> <span>21,242</span></div>
          <div class="bar yellow" style="width: 70%;"></div>

          <div><span>Filmer Elston</span> <span>17,832</span></div>
          <div class="bar red" style="width: 58%;"></div>
        </div>
      </div>

      <!-- Average Sales Cycle -->
      <div class="card">
        <p>Average Sales Cycle</p>
        <canvas id="salesCycleChart"></canvas>
      </div>

      <!-- Opportunity by Country -->
      <div class="card">
        <p>Opportunity Amount by Country</p>
        <div class="map-placeholder">[MAP PLACEHOLDER]</div>
      </div>

    </div>
  </div>

  <script>
    // Opportunity Amount vs Created Chart
    new Chart(document.getElementById("opportunityChart"), {
      type: 'bar',
      data: {
        labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        datasets: [
          {
            label: 'Opportunity Amount',
            backgroundColor: '#38bdf8',
            data: [1.6, 2.0, 1.3, 1.9, 2.2, 2.6, 2.0]
          },
          {
            label: 'Opportunities',
            type: 'line',
            borderColor: '#10b981',
            backgroundColor: 'transparent',
            data: [1200, 1400, 1000, 1600, 1800, 1900, 1700],
            tension: 0.3
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Opportunity by Stage Chart
    new Chart(document.getElementById("stageChart"), {
      type: 'bar',
      data: {
        labels: ['Qualification', 'Proposal', 'Negotiation', 'Needs Analysis', 'Closed Won', 'Closed Lost'],
        datasets: [{
          label: 'Opportunity Amount',
          backgroundColor: '#facc15',
          data: [500, 1200, 800, 700, 600, 200]
        }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: {
            beginAtZero: true
          }
        }
      }
    });

    // Average Sales Cycle Line Chart
    new Chart(document.getElementById("salesCycleChart"), {
      type: 'line',
      data: {
        labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
          label: 'Average Sales Cycle',
          data: [900, 1200, 1100, 1300, 1000, 1600],
          fill: false,
          borderColor: '#ef4444',
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
  </script>

</body>
</html>


@include('admin.footer')